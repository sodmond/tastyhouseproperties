<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/user/home';
    public const ADMINHOME = '/admin/home';
    public const SELLERHOME = '/seller/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        /*RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });*/
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapTHCRoutes();
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapTHCSellerRoutes();
        $this->mapSellerRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {#dd(url('/'));
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->prefix('admin')
            ->namespace($this->namespace)
            ->as('admin.')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "seller" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapSellerRoutes()
    {
        Route::middleware('web')
            ->prefix('seller')
            ->namespace($this->namespace)
            ->as('seller.')
            ->group(base_path('routes/seller.php'));
    }

    /**
     * Define the "thc" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapTHCRoutes()
    {
        Route::domain(config('app.domain2'))
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/thc.php'));
    }

    /**
     * Define the "thc seller" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapTHCSellerRoutes()
    {
        Route::domain(config('app.domain2'))
            ->middleware('web')
            ->prefix('seller')
            ->namespace($this->namespace)
            ->as('thc_seller.')
            ->group(base_path('routes/thc_seller.php'));
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
