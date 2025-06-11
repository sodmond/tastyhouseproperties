<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cur_domain = request()->server->get('SERVER_NAME');
        if (auth('seller')->user()->type == 'store' && $cur_domain == config('app.domain2')) {
            auth('seller')->logout();
            return redirect(config('app.url').'/seller/login')->withErrors(['err_msg' => "You've been redirected here because you registered on TastyHouse Stores"]);
        }
        if (auth('seller')->user()->type != 'store' && $cur_domain != config('app.domain2')) {
            auth('seller')->logout();
            return redirect(config('app.url2').'/seller/login')->withErrors(['err_msg' => "You've been redirected here because you registered on TastyHouse Club"]);
        }
        return $next($request);
    }
}
