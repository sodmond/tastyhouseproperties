<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
#use App\Models\AuthorParent;
use App\Models\Shipping;
use App\Notifications\EmailVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('seller.auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:sellers'],
            'phone' => ['required', 'numeric', 'unique:sellers'],
            'password' => ['required', 'confirmed', 'min:8'],
            'g-recaptcha-response' => 'recaptcha',
        ],[
            'recaptcha' => 'You need to complete the recaptcha field'
        ]);
        $data = $request->all();
        $seller = Seller::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        #AuthorParent::create(['seller_id' => $seller->id]);
        Auth::guard('seller')->login($seller);
        auth('seller')->user()->notify(new EmailVerify);
        return redirect()->route('seller.profile');
    }
}
