<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as MiddlewareEnsureEmailIsVerified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified extends MiddlewareEnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $guards = array_keys(config('auth.guards')); //dd(auth()->guard()->getName());

        foreach($guards as $guard) {

            if ($guard == 'admin') {
    
                if (Auth::guard($guard)->check()) {
    
                    if (! Auth::guard($guard)->user() ||
                        (Auth::guard($guard)->user() instanceof MustVerifyEmail &&
                        ! Auth::guard($guard)->user()->hasVerifiedEmail())) {
                        return $request->expectsJson()
                                ? abort(403, 'Your email address is not verified.')
                                : Redirect::route('admin.verification.notice');
                    }  
    
                }
    
            }

            if ($guard == 'seller') {
    
                if (Auth::guard($guard)->check()) {
    
                    if (! Auth::guard($guard)->user() ||
                        (Auth::guard($guard)->user() instanceof MustVerifyEmail &&
                        ! Auth::guard($guard)->user()->hasVerifiedEmail())) {
                        return $request->expectsJson()
                                ? abort(403, 'Your email address is not verified.')
                                : Redirect::route('seller.verification.notice');
                    }  
    
                }
    
            }

            if ($guard == 'web') {
    
                if (Auth::guard($guard)->check()) {
    
                    if (! Auth::guard($guard)->user() ||
                        (Auth::guard($guard)->user() instanceof MustVerifyEmail &&
                        ! Auth::guard($guard)->user()->hasVerifiedEmail())) {
                        return $request->expectsJson()
                                ? abort(403, 'Your email address is not verified.')
                                : Redirect::route('verification.notice');
                    }  
    
                }
    
            }
        }
        return $next($request);
    }
}
