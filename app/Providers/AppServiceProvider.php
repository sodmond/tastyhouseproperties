<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\State;
use App\Models\Wishlist;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        if (request()->server->get('SERVER_NAME') == config('app.domain2')) {
            Vite::createAssetPathsUsing(fn (string $path) => asset2($path));
        }
        try {
            $th_categories1 = ProductCategory::where('level', 1)->get();
            $currency = '₦';
            $th_states = State::orderBy('name')->get();
            $th_location_name = 'All Nigeria';
            $cookieName = getLocationCookie();
            if (isset($_COOKIE[$cookieName])) {
                $location = explode('_', $_COOKIE[$cookieName]);
                if (count($location) == 2) {
                    $locationType = $location[0];
                    $locationId = $location[1];
                    if (!empty($locationType) && !empty($locationId)) {
                        if ($locationType == 'city') {
                            $city = \App\Models\City::find($locationId);
                            $th_location_name = $city->name .', '. $city->state->name;
                        } else {
                            $th_location_name = \App\Models\State::find($locationId)->name.', NG';
                        }
                    }
                }
            }
            View::share(compact('th_categories1', 'currency', 'th_states', 'th_location_name'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
