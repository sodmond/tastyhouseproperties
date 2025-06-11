<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subscription = Subscription::where('seller_id', auth('seller')->id())->where('type', 'general')
                    ->orderByDesc('created_at')->first();
        if($subscription) {
            if($subscription->end_date > date('Y-m-d')) {
                return $next($request);
            }
        }
        return redirect()->route('seller.settings');
    }
}
