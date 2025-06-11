<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth('web')->id())->orderByDesc('created_at')->paginate(10);
        return view('user.wishlist', compact('wishlist'));
    }

    public function addItem(Request $request)
    {
        $this->validate($request, [
            'product_id' => ['required', 'integer']
        ]);
        $wishlist = Wishlist::where('product_id', $request->product_id)->get();
        if ($wishlist->count() < 1) {
            Wishlist::create([
                'user_id' => auth('web')->id(),
                'product_id' => $request->product_id,
            ]);
        }
        return back();
    }

    public function removeItem(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'integer']
        ]);
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
        }
        return back();
    }
}
