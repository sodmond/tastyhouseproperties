<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        Session::put('auth.usertype', 'seller');
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        //
    }
}
