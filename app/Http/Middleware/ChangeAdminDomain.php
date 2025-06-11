<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeAdminDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $curDomain = $_SERVER['SERVER_NAME'];
        if ($curDomain == config('app.domain2')) {
            $updatedAdminUrl = config('app.url').$_SERVER['REQUEST_URI'];
            return redirect($updatedAdminUrl);
        }
        return $next($request);
    }
}
