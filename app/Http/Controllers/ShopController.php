<?php

namespace App\Http\Controllers;

use App\Mail\SendAbuseReport;
use App\Models\AbuseReport;
use App\Models\Advert;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\State;
use App\Models\Subscription;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
    public function index()
    {
        $cookieName = getLocationCookie();
        $orderBy = 'orderByDesc';
        $orderField = 'created_at';
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            if ($sortBy == 'popularity') {
                $orderBy = 'orderByDesc';
                $orderField = 'views';
            }
            if ($sortBy == 'newest' || empty($sortBy)) {
                $orderBy = 'orderByDesc';
                $orderField = 'created_at';
            }
            if ($sortBy == 'lowest_price') {
                $orderBy = 'orderBy';
                $orderField = 'price';
            }
            if ($sortBy == 'highest_price') {
                $orderBy = 'orderByDesc';
                $orderField = 'price';
            }
        }
        $minPrice = 50000;
        $maxPrice = 1000000000;
        if (isset($_GET['price_range'])) {
            $price_range = explode(';', $_GET['price_range']);
            $minPrice = $price_range[0] ?? 0;
            $maxPrice = $price_range[1] ?? 100000000;
        }
        if (isset($_COOKIE[$cookieName])) {
            $location = explode('_', $_COOKIE[$cookieName]);
            if (count($location) == 2) {
                $locationType = $location[0];
                $locationId = $location[1];
                if (!empty($locationType) && !empty($locationId)) {
                    if ($locationType == 'city') {
                        $products = Product::where('city_id', $locationId)->havingBetween('price', [$minPrice, $maxPrice])->orderBy('prime_status', 'desc')->{$orderBy}($orderField)->paginate(20);
                        $locationData = City::find($locationId);
                        return view('shop', compact('products', 'locationData'));
                    }
                    $cities = City::where('state_id', $locationId)->pluck('id');
                    $locationData = State::find($locationId);
                    $products = Product::whereIn('city_id', $cities)->havingBetween('price', [$minPrice, $maxPrice])->orderBy('prime_status', 'desc')->{$orderBy}($orderField)->paginate(20);
                    return view('shop', compact('products', 'locationData'));
                }
            }
        }
        $products = Product::havingBetween('price', [$minPrice, $maxPrice])->orderBy('prime_status', 'desc')->{$orderBy}($orderField)->paginate(20);
        return view('shop', compact('products'));
    }

    public function view($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $category = ProductCategory::find($product->product_category_id);
        $related = Product::where('product_category_id', $product->product_category_id)->where('id', '<>', $product->id)->take(10)->get();
        $product->views += 1;
        $product->save();
        $favorite = false;
        $adverts = Advert::all();
        if (auth('web')->check()) {
            $user_wishlist = Wishlist::where('user_id', auth('web')->id())->where('product_id', $product->id)->first();
            $favorite = isset($user_wishlist->id) ? true : false ;
        }
        return view('product_details', compact('product', 'category', 'related', 'favorite', 'adverts'));
    }

    public function category($id)
    {
        $category = ProductCategory::find($id);
        $cookieName = getLocationCookie();
        $cat2 = $this->convertToSQLArray([$category->id]);
        $cat3 = $this->convertToSQLArray([$category->id]);
        if ($category->level == 1) {
            $cat2 = ProductCategory::where('parent', $category->id)->pluck('id');
            $cat2 = $this->convertToSQLArray($cat2);
        }
        $orderBy = 'orderByDesc';
        $orderField = 'created_at';
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            if ($sortBy == 'popularity') {
                $orderBy = 'orderByDesc';
                $orderField = 'views';
            }
            if ($sortBy == 'newest' || empty($sortBy)) {
                $orderBy = 'orderByDesc';
                $orderField = 'created_at';
            }
            if ($sortBy == 'lowest_price') {
                $orderBy = 'orderBy';
                $orderField = 'price';
            }
            if ($sortBy == 'highest_price') {
                $orderBy = 'orderByDesc';
                $orderField = 'price';
            }
        }
        $minPrice = 0;
        $maxPrice = 100000000;
        if (isset($_GET['price_range'])) {
            $price_range = explode(';', $_GET['price_range']);
            $minPrice = $price_range[0] ?? 0;
            $maxPrice = $price_range[1] ?? 100000000;
        }
        if (isset($_COOKIE[$cookieName])) {
            $location = explode('_', $_COOKIE[$cookieName]);
            if (count($location) == 2) {
                $locationType = $location[0];
                $locationId = $location[1];
                if (!empty($locationType) && !empty($locationId)) {
                    if ($locationType == 'city') {
                        $products = Product::where('product_category_id', $category->id)->where('city_id', $locationId)
                            ->orWhereRaw("product_category_id IN $cat2 AND city_id = $locationId")
                            ->havingBetween('price', [$minPrice, $maxPrice])
                            ->orderBy('prime_status', 'desc')
                            ->{$orderBy}($orderField)->paginate(20);
                        $locationData = City::find($locationId);
                        return view('shop_category', compact('category', 'products', 'locationData'));
                    }
                    $cities = City::where('state_id', $locationId)->pluck('id');
                    $locationData = State::find($locationId); 
                    $cities_str = $this->convertToSQLArray($cities); #dd($cat3);
                    $products = Product::whereRaw("product_category_id = $category->id AND city_id IN $cities_str")
                        ->orWhereRaw("product_category_id IN $cat2 AND city_id IN $cities_str")
                        ->havingBetween('price', [$minPrice, $maxPrice])
                        ->orderBy('prime_status', 'desc')
                        ->{$orderBy}($orderField)->paginate(20);
                    return view('shop_category', compact('category', 'products', 'locationData'));
                }
            }
        }
        $products = Product::where('product_category_id', $category->id)
            ->orWhereRaw("product_category_id IN $cat2")
            ->havingBetween('price', [$minPrice, $maxPrice])
            ->orderBy('prime_status', 'desc')
            ->{$orderBy}($orderField)->paginate(20);
        return view('shop_category', compact('category', 'products'));
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $cookieName = getLocationCookie();
            if (isset($_COOKIE[$cookieName])) {
                $location = explode('_', $_COOKIE[$cookieName]);
                if (count($location) == 2) {
                    $locationType = $location[0];
                    $locationId = $location[1];
                    if (!empty($locationType) && !empty($locationId)) {
                        if ($locationType == 'city') {
                            $products = Product::where('title', 'LIKE', "%$search%")->where('city_id', $locationId)->orderBy('prime_status', 'desc')->orderByDesc('created_at')->paginate(20);
                            $locationData = City::find($locationId);
                            return view('shop_category', compact('products', 'locationData'));
                        }
                        $cities = City::where('state_id', $locationId)->pluck('id');
                        $locationData = State::find($locationId);
                        $products = Product::where('title', 'LIKE', "%$search%")->whereIn('city_id', $cities)->orderBy('prime_status', 'desc')->orderByDesc('created_at')->paginate(20);
                        return view('shop_category', compact('products', 'locationData'));
                    }
                }
            }
            $products = Product::where('title', 'LIKE', "%$search%")->orderBy('prime_status', 'desc')->orderByDesc('created_at')->paginate(20);
            return view('search', compact('products'));
        }
        return view('search');
    }

    public function prime()
    {
        $cookieName = getLocationCookie();
        $orderBy = 'orderByDesc';
        $orderField = 'created_at';
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            if ($sortBy == 'popularity') {
                $orderBy = 'orderByDesc';
                $orderField = 'views';
            }
            if ($sortBy == 'newest' || empty($sortBy)) {
                $orderBy = 'orderByDesc';
                $orderField = 'created_at';
            }
            if ($sortBy == 'lowest_price') {
                $orderBy = 'orderBy';
                $orderField = 'price';
            }
            if ($sortBy == 'highest_price') {
                $orderBy = 'orderByDesc';
                $orderField = 'price';
            }
        }
        $minPrice = 0;
        $maxPrice = 100000000;
        if (isset($_GET['price_range'])) {
            $price_range = explode(';', $_GET['price_range']);
            $minPrice = $price_range[0] ?? 0;
            $maxPrice = $price_range[1] ?? 100000000;
        }
        if (isset($_COOKIE[$cookieName])) {
            $location = explode('_', $_COOKIE[$cookieName]);
            if (count($location) == 2) {
                $locationType = $location[0];
                $locationId = $location[1];
                if (!empty($locationType) && !empty($locationId)) {
                    if ($locationType == 'city') {
                        $products = Product::where('city_id', $locationId)->where('prime_status', 1)->havingBetween('price', [$minPrice, $maxPrice])->{$orderBy}($orderField)->paginate(20);
                        $locationData = City::find($locationId);
                        return view('shop_prime', compact('products', 'locationData'));
                    }
                    $cities = City::where('state_id', $locationId)->pluck('id');
                    $locationData = State::find($locationId);
                    $products = Product::whereIn('city_id', $cities)->where('prime_status', 1)->havingBetween('price', [$minPrice, $maxPrice])->{$orderBy}($orderField)->paginate(20);
                    return view('shop_prime', compact('products', 'locationData'));
                }
            }
        }
        $products = Product::where('prime_status', 1)->havingBetween('price', [$minPrice, $maxPrice])->{$orderBy}($orderField)->paginate(20);
        return view('shop_prime', compact('products'));
    }

    public function changeLocation()
    {
        if(isset($_GET['id']) && isset($_GET['type'])) {
            $cookieName = getLocationCookie(); 
            $cookieVal = $_GET['type'] .'_'. $_GET['id'];
            setcookie($cookieName, $cookieVal, time() + (86400 * 30));
            return back();
        }
        return redirect('/');
    }

    public function resetLocation()
    {
        $cookieName = getLocationCookie();
        setcookie($cookieName, '', time() - 3600);
        return back();
    }

    public function abuseReport($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'g-recaptcha-response' => ['recaptcha']
        ],[
            'recaptcha' => 'You need to complete the recaptcha field'
        ]);
        $product = Product::find($id);
        try {
            $report = AbuseReport::create([
                'user_id' => auth('web')->id(),
                'product_id' => $product->id,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            Mail::to('support@tastyhousestores.com')->send(new SendAbuseReport($report));
            return back()->with('success', 'Report has been submitted');
        } catch(\Exception $e) {
            Log::info($e->getMessage());
            return back()->withErrors(['err_msg' => 'Problem encountered, report not submitted, pls try again.']);
        }
    }

    public function convertToSQLArray($arr)
    {
        return str_replace(']', ')', str_replace('[', '(', json_encode($arr)));
    }
}
