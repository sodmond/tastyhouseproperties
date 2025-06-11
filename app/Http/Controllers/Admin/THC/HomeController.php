<?php

namespace App\Http\Controllers\Admin\THC;

use App\Exports\NewsletterExport;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\THC\Product;
use App\Models\Seller;
use App\Models\Subscription;
use App\Models\THC\Category;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return redirect()->route('admin.home');
    }

    public function index()
    {
        $sellers = Seller::all();
        $users = User::all();
        $categories1 = Category::where('level', 1)->get();
        $products = Product::all();
        $subscriptions = Subscription::all();
        $orders = Order::all();
        return view('admin.thc.home', compact(
            'sellers', 'users', 'categories1', 'products', 'subscriptions', 'orders'
        ));
    }

    public function getSellerProducts($seller_id)
    {
        $products = Product::where('seller_id', $seller_id)->get()->keyBy('id');
        if ($products) {
            return response()->json($products->toArray(), 200);
        }
        return response()->json([], 404);
    }
}
