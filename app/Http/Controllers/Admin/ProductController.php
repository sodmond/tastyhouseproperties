<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Models\AbuseReport;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\State;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $searchVal = $_GET['search'];
            $products = Product::where('title', 'LIKE', "%$searchVal%")->orderByDesc('created_at')->paginate(10);
            return view('admin.products.index', compact('products'));
        }
        $products = Product::orderByDesc('created_at')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function get($id)
    {
        $product = Product::withTrashed()->find($id);
        return view('admin.products.single', compact('product'));
    }

    public function new()
    {
        $categories = ProductCategory::where('level', 1)->get();
        $states = State::all();
        return view('admin.products.new', compact('categories', 'states'));
    }

    public function export()
    {
        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
            $dateObj = DateTime::createFromFormat('!m', $month);
            $monthName = $dateObj->format('F');
            $fileName = 'products-'.$monthName.$year.'.xlsx';
            return Excel::download(new ProductsExport($month, $year), $fileName);
        }
        return redirect()->back();
    }

    public function trash($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return back()->with('success', 'Product has been deleted');
        }
        return redirect()->route('admin.products');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product) {
            $product->restore();
            return back()->with('success', 'Product has been restored');
        }
        return redirect()->route('admin.products');
    }

    public function abuseReports($id)
    {
        $product = Product::find($id);
        $abuse_reports = AbuseReport::where('product_id', $id)->orderByDesc('created_at')->paginate(10);
        return view('admin.products.reports', compact('product', 'abuse_reports'));
    }

    /*public function addNew(ProductRequest $request)
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
        $thumbnail = ImageManager::imagick()->read($request->file('image')[0]->path());
        $thumbnail->cover(400, 400, 'center')->save(storage_path('/app/public/products/'.auth('seller')->id().'/thumbnail/'. $images[0]));
        $product->image = json_encode($images);
        if ($product->save()) {
            return back()->with('success', 'Product has been added.');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again']);
    }*/

    public function edit($id)
    {
        $product = Product::find($id);
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
        $states = State::all();
        $cities = City::where('state_id', $product->city->state->id)->get();
        return view('admin.products.edit', compact('product', 'categories', 'cat_choice', 'states', 'cities'));
    }
}
