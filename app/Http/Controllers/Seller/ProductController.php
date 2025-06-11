<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\State;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['seller.verify', 'seller.subcheck']);
    }
    
    public function index()
    {
        $products = Product::where('seller_id', auth('seller')->id())->orderBy('prime_status', 'desc')
            ->orderByDesc('created_at')->paginate(10);
        return view('seller.products.index', compact('products'));
    }

    public function new()
    {
        $categories = ProductCategory::where('level', 1)->get();
        $states = State::all();
        return view('seller.products.new', compact('categories', 'states'));
    }

    public function addNew(ProductRequest $request)
    {
        $product = new Product();
        $product->seller_id = auth('seller')->id();
        $product->product_category_id = $request->category3 ?? $request->category2;
        $product->title = $request->title;
        $product->price = $request->price ?? 0;
        $product->price_type = $request->price_type;
        $product->condition = $request->condition;
        $product->slug = genrateSlug([$request->title, $request->condition]);
        $product->description = $request->description;
        $product->city_id = $request->city;
        $images = [];
        foreach ($request->file('image') as $image) {
            $imgName = Str::random().'.'.$image->extension();
            $image->storeAs("products/".auth('seller')->id(), $imgName, 'public');
            $images[] = $imgName;
        }
        File::ensureDirectoryExists(storage_path('/app/public/products/'.auth('seller')->id().'/thumbnail'));
        $thumbnail = ImageManager::gd()->read($request->file('image')[0]->path());
        $thumbnail->cover(400, 400, 'center')->save(storage_path('/app/public/products/'.auth('seller')->id().'/thumbnail/'. $images[0]));
        $product->image = json_encode($images);
        $attributes = Attribute::all();
        if ($product->save()) {
            foreach($attributes as $attribute) {
                $cats = json_decode($attribute->categories);
                if ((in_array($request->category3, $cats) || in_array($request->category2, $cats)) && !empty($request->{strtolower($attribute->title)})) {
                    $value = (gettype($request->{strtolower($attribute->title)}) == 'array') ? $request->{strtolower($attribute->title)} : [$request->{strtolower($attribute->title)}] ;
                    ProductTag::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attribute->id, 
                        'value' => json_encode($value)
                    ]);
                }
            }
            return back()->with('success', 'Product has been added.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again']);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if ($product->seller_id != auth('seller')->id()) {
            return back();
        }
        $categories = [];
        $categories[0] = ProductCategory::where('level', 1)->get();
        if($product->category->level == 2){
            $cat_choice = [$product->category->parent, $product->product_category_id, ''];
            $categories[1] = ProductCategory::where('parent', $product->category->parent)->get();
            $categories[2] = ProductCategory::where('parent', $product->category->id)->get();
        }
        if($product->category->level == 3){
            $findMainCat = ProductCategory::find($product->category->parent);
            $cat_choice = [$findMainCat->parent, $product->category->parent, $product->product_category_id];
            $categories[1] = ProductCategory::where('parent', $findMainCat->parent)->get();
            $categories[2] = ProductCategory::where('parent', $product->category->parent)->get();
        }
        $product_tags = ProductTag::where('product_id', $product->id)->get();
        $states = State::all();
        $cities = City::where('state_id', $product->city->state->id)->get();
        return view('seller.products.edit', compact('product', 'categories', 'cat_choice', 'states', 'cities', 'product_tags'));
    }

    public function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        if ($product->seller_id != auth('seller')->id()) {
            return back();
        }
        $product->product_category_id = $request->category3 ?? $request->category2;
        $product->title = $request->title;
        $product->price = $request->price ?? 0;
        $product->price_type = $request->price_type;
        $product->condition = $request->condition;
        $product->slug = genrateSlug([$request->title, $request->condition]);
        $product->description = $request->description;
        $product->city_id = $request->city;
        if(!empty($request->image)) {
            $productImages = json_decode($product->image);
            foreach($request->file('image') as $key => $image) {
                if(isset($productImages[$key])) {
                    if (Storage::exists('public/products/'.auth('seller')->id().'/'.$productImages[$key])) {
                        Storage::delete('public/products/'.auth('seller')->id().'/'.$productImages[$key]);
                    }
                }
                $imgName = Str::random().'.'.$image->extension();
                $image->storeAs("products/".auth('seller')->id(), $imgName, 'public');
                $productImages[$key] = $imgName;
            }
            if (isset($request->image[0])) {
                if (Storage::exists('public/products/'.auth('seller')->id().'/thumbnail/'.$productImages[0])) {
                    Storage::delete('public/products/'.auth('seller')->id().'/thumbnail/'.$productImages[0]);
                }
                $thumbnail = ImageManager::gd()->read($request->file('image')[0]->path());
                $thumbnail->cover(400, 400, 'center')->save(storage_path('/app/public/products/'.auth('seller')->id().'/thumbnail/'. $productImages[0]));
            }
            $product->image = json_encode($productImages);
        }
        $attributes = Attribute::all();
        if ($product->save()) {
            foreach($attributes as $attribute) {
                $cats = json_decode($attribute->categories);
                if (in_array($request->category3, $cats) || in_array($request->category2, $cats)) {
                    ProductTag::where('product_id', $product->id)->where('attribute_id', $attribute->id)
                        ->update(['value' => json_encode($request->{strtolower($attribute->title)})]);
                }
            }
            return back()->with('success', 'Product has been updated.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again']);
    }

    public function trash(Request $request)
    {
        $this->validate($request, [
            'product_id' => ['required', 'numeric']
        ]);
        $product = Product::find($request->product_id);
        if ($product) {
            $product->delete();
            return back()->with('success', 'Product has been deleted');
        }
        return back()->withErrors(['err_msg' => 'Product cannot be found']);
    }

    public function setPrime(Request $request)
    {
        $this->validate($request, [
            'product_id' => ['required', 'numeric', 'exists:products,id']
        ]);
        $primeSub = Subscription::where('seller_id', auth('seller')->id())->where('type', 'prime')->latest()->first();
        if (! isset($primeSub->id)) {
            return back()->withErrors(['err_msg' => "You don't have an active prime subscription"]);
        }
        if ($primeSub->end_date > date('Y-m-d')) {
            $primeProducts = Product::where('seller_id', auth('seller')->id())->where('prime_status', 1);
            $primeProd = json_decode($primeSub->product_id);
            if($primeProducts->count() < 3 && !in_array($request->product_id, $primeProducts->pluck('id')->toArray())) {
                $primeProd[] = $request->product_id;
                $primeSub->product_id = json_encode($primeProd);
                Product::where('id', $request->product_id)->update(['prime_status' => 1]);
                $primeSub->save();
                return back()->with('success', 'Your Prime Product has been updated');
            }
            if(in_array($request->product_id, $primeProducts->pluck('id')->toArray())) {
                $pos = array_search($request->product_id, $primeProd);
                unset($primeProd[$pos]);
                $primeSub->product_id = json_encode(array_values($primeProd));
                Product::where('id', $request->product_id)->update(['prime_status' => 0]);
                $primeSub->save();
                return back()->with('success', 'Your Prime Product has been updated');
            }
            return back()->withErrors(['err_msg' => "You can only set 3 prime products"]);
        }
        return back()->withErrors(['err_msg' => "You don't have an active prime subscription"]);
    }

    public function tags()
    {
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $attributes = Attribute::all();
            $result = [];
            foreach($attributes as $attribute) {
                if (in_array($category_id, json_decode($attribute->categories))) {
                    $result[$attribute->title]['option_type'] = $attribute->option_type;
                    $result[$attribute->title]['values'] = json_decode($attribute->values);
                }
            }
            if (count($result) > 0) {
                return response()->json($result, 200);
            }
            return response()->json(['message' => 'No records found'], 404);
        }
        return response()->json(['message' => 'This operation is not allowed'], 403);
    }
}
