<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\SellerReview;
use App\Models\Subscription;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function about()
    {
        return view('seller_become');
    }

    public function index()
    {
        return view('sellers');
    }

    public function view()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $seller = Seller::find($id);
            if(isset($seller->id)) {
                if (empty($seller->slug)) {
                    $slugText = empty($seller->companyname) ? [$seller->firstname, $seller->lastname] : [$seller->companyname];
                    $slug = Seller::getSlug($slugText);
                    $seller->update(['slug' => $slug]);
                    return redirect()->route('seller.shop', ['slug' => $slug]);
                }
            }
            $products = Product::where('seller_id', $seller->id)->orderBy('prime_status', 'desc')->orderByDesc('created_at')->paginate(10);
            $primeProducts = Subscription::where('end_date', '>', now())->where('type', 'prime')->pluck('product_id')->toArray();
            return view('seller_details', compact('seller', 'products', 'primeProducts'));
        }
        return redirect('/');
    }

    public function shop($slug)
    {
        $seller = Seller::where('slug', $slug)->first();
        if(isset($seller->id)) {
            if ($seller->status == 0) {
                return redirect()->route('shop');
            }
            if (isset($_GET['category'])) {
                $catId = $_GET['category'];
                $category = ProductCategory::find($catId); 
                $cat_subs = ProductCategory::where('parent', $category->id)->pluck('id');
                $products = Product::where('seller_id', $seller->id)->whereIn('product_category_id', $cat_subs)
                    ->orderBy('prime_status', 'desc')->orderByDesc('created_at')->paginate(10);
                return view('seller_details', compact('seller', 'products'));
            }
            $products = Product::where('seller_id', $seller->id)->orderBy('prime_status', 'desc')->orderByDesc('created_at')->paginate(10);
            $primeProducts = Subscription::where('end_date', '>', now())->where('type', 'prime')->pluck('product_id')->toArray();
            return view('seller_details', compact('seller', 'products', 'primeProducts'));
        }
        return redirect('/shop');
    }

    public function reviews()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $seller = Seller::find($id);
            $reviews = SellerReview::where('seller_id', $seller->id)->orderByDesc('created_at')->paginate(10);
            return view('seller_reviews', compact('seller', 'reviews'));
        }
        return redirect('/');
    }
}
