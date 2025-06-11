<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Seller;
use App\Models\SellerReview;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = SellerReview::where('user_id', auth('web')->id())->paginate(10);
        return view('user.reviews.index', compact('reviews'));
    }

    public function get($id)
    {
        $review = SellerReview::find($id);
        if ($review->user_id == auth('web')->id()) {
            return view('user.reviews.single', compact('review'));
        }
        return back();
    }

    public function new()
    {
        $chats = Chat::where('user_id', auth('web')->id())->pluck('seller_id');
        $reviews = SellerReview::where('user_id', auth('web')->id())->pluck('seller_id');
        $sellers = Seller::whereIn('id', $chats)->whereNotIn('id', $reviews)->get();
        return view('user.reviews.new', compact('sellers'));
    }

    public function addNew(Request $request)
    {#dd($request->all());
        $this->validate($request, [
            'seller_id' => ['required', 'integer', 'exists:sellers,id'],
            'rating' => ['required', 'integer', 'max:5'],
            'comment' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'array', 'max:5'],
            'image.*' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:512', Rule::dimensions()->minWidth(370)->minHeight(370)]
        ]);
        $review = new SellerReview();
        $review->user_id = auth('web')->id();
        $review->seller_id = $request->seller_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        if($request->has('image')) {
            $productImages = [];
            foreach($request->file('image') as $key => $image) {
                $imgName = Str::random(32).'.'.$image->extension();
                $image->storeAs("reviews", $imgName, 'public');
                $productImages[] = $imgName;
            }
            $review->images = json_encode($productImages);
        }
        if ($review->save()) {
            return back()->with('success', 'Review has been submitted');
        }
        return back()->withErrors(['err_msg' => 'Problem encountered, pls try again.']);
    }
}
