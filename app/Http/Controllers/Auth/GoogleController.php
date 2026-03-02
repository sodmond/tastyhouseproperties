<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        Session::put('auth.usertype', 'buyer');
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        $type = Session::pull('auth.usertype');
        $user = Socialite::driver('google')->user();
        if ($type == 'seller') {
            #dd($type, $user, $user->user['given_name']);
            $findSeller = Seller::where('google_id', $user->id)->where('email', $user->email)->first();
            if ($findSeller) {
                Auth::guard('seller')->login($findSeller);
                return redirect()->route('seller.home');
            } else {
                $newSeller = Seller::updateOrCreate(['email' => $user->email],[
                    'firstname' => $user->user['given_name'],
                    'lastname' => $user->user['family_name'] ?? $user->user['given_name'],
                    'password' => Hash::make(Str::random()),
                    'google_id'=> $user->id,
                ]);
                $newSeller->markEmailAsVerified();
                Auth::guard('seller')->login($newSeller);
                return redirect()->route('seller.home');
            }
        }
        if ($type == 'buyer') {
            $findBuyer = User::where('google_id', $user->id)->where('email', $user->email)->first();
            if ($findBuyer) {
                Auth::guard('web')->login($findBuyer);
                return redirect()->route('user.home');
            } else {
                $newBuyer = User::updateOrCreate(['email' => $user->email],[
                    'firstname' => $user->user['given_name'],
                    'lastname' => $user->user['family_name'] ?? $user->user['given_name'],
                    'password' => Hash::make(Str::random()),
                    'google_id'=> $user->id,
                    'email_verified_at' => now()
                ]);
                Auth::guard('web')->login($newBuyer);
                return redirect()->route('user.home');
            }
        }
        dd($type, $user);
    }
}
