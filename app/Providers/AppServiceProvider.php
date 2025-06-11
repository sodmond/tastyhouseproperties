<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\State;
use App\Models\THC\Category;
use App\Models\THC\Deals;
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
            $th_categories2 = ProductCategory::where('level', 2)->get();
            $th_categories3 = ProductCategory::where('level', 3)->get();
            $thc_categories1 = Category::where('level', 1)->get();
            $thc_categories2 = Category::where('level', 2)->get();
            $thc_deals = Deals::all();
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
            View::share(compact('th_categories1', 'th_categories2', 'th_categories3', 'thc_categories1', 
                'thc_categories2', 'currency', 'th_states', 'th_location_name', 'thc_deals'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
