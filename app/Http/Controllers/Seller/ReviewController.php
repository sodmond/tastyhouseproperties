<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = SellerReview::where('seller_id', auth('seller')->id())->paginate(10);
        return view('seller.reviews.index', compact('reviews'));
    }

    public function get($id)
    {
        $review = SellerReview::find($id);
        if ($review->seller_id == auth('seller')->id()) {
            return view('seller.reviews.single', compact('review'));
        }
        return back();
    }
}
