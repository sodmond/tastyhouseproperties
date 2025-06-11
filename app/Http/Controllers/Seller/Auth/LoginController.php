<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Auth\LoginController as DefaultLoginController;
use App\Models\Admin;
use App\Notifications\LoginAlert;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends DefaultLoginController
{
    protected $redirectTo = RouteServiceProvider::SELLERHOME;

    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 30; // Default is 1

    public function __construct()
    {
        $this->middleware('guest:seller')->except('logout');
    }

    public function showLoginForm()
    {
        return view('seller.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('seller')->attempt($credentials, $request->get('remember'))) {
            if (auth('seller')->user()->status == false) {
                Auth::guard('seller')->logout();
                return redirect()->route('seller.login');
            }
            return redirect()->route('seller.home');
            #return redirect()->intended();
        }
        return redirect()->route('seller.login')->withInput()->withErrors(['err_msg' => 'Opps! You have entered invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login');
    }
    
    /*public function username()
    {
        return 'username';
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }*/
}
