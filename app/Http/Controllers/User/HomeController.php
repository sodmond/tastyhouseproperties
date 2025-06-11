<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SellerReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $reviews = SellerReview::where('user_id', auth('web')->id());
        $wishlist = Wishlist::where('user_id', auth('web')->id());
        return view('user.home', compact('reviews', 'wishlist'));
    }
}
