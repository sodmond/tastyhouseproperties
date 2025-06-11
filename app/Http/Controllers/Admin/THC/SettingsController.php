<?php

namespace App\Http\Controllers\Admin\THC;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\THC\Advert;
use App\Models\THC\Deals;
use App\Models\THC\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function adverts()
    {
        $adverts = Advert::all();
        return view('admin.thc.settings.adverts', compact('adverts'));
    }

    public function advert($id)
    {
        $advert = Advert::find($id);
        return view('admin.thc.settings.advert', compact('advert'));
    }

    public function advertUpdate($id, Request $request)
    {
        $advert = Advert::find($id);
        $this->validate($request, [
            'title'=> ['required', 'string', 'max:255'],
            /*'width'=> ['required', 'numeric'],
            'height'=> ['required', 'numeric'],*/
            'cost'=> ['required', 'numeric'],
            'image'=> ['nullable', 'image', 'mimes:jpg,png,jpeg', Rule::dimensions()->width($advert->width)->height($advert->height)],
            'url' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:20'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
        $advertData = $request->except(['_token', 'image']);
        if ($request->has('image')) {
            if (Storage::exists('public/advert/'.$advert->image)) {
                Storage::delete('public/advert/'.$advert->image);
            }
            $imgFileName =  Str::random(32) . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('advert', $imgFileName, 'public');
            $advertData = array_merge($advertData, ['image' => $imgFileName]);
        }
        $advert->update($advertData);
        return back()->with('success', 'Advert details has been updated');
    }

    public function deals()
    {
        $deals = Deals::all();
        return view('admin.thc.settings.deals', compact('deals'));
    }

    public function deal($id)
    {
        $deal = Deals::find($id);
        $sellers = Seller::all();
        $products = Product::where('seller_id', $deal->product->seller_id)->get()->keyBy('id');
        return view('admin.thc.settings.deal', compact('deal', 'sellers', 'products'));
    }

    public function dealUpdate($id, Request $request)
    {
        $deal = Deals::find($id);
        $this->validate($request, [
            'product_id'=> ['required', 'integer', 'exists:thc_products,id'],
            'price'=> ['required', 'numeric'],
            'expires_at' => ['required', 'date'],
        ]);
        $dealData = $request->except(['_token']);
        $deal->update($dealData);
        return back()->with('success', 'Deal details has been updated');
    }
}
