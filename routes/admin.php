<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as AdminBackend;

/*
|--------------------------------------------------------------------------
| Author Routes
|--------------------------------------------------------------------------
|
| Here is where you can register author routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminBackend\HomeController::class, 'home']);

Route::group(['middleware' => ['change.admindomain']], function() {
    Route::get('login', [AdminBackend\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminBackend\Auth\LoginController::class, 'login']);
    Route::post('logout', [AdminBackend\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('password/confirm', [AdminBackend\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [AdminBackend\Auth\ConfirmPasswordController::class, 'confirm']);
    Route::get('password/reset', [AdminBackend\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AdminBackend\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AdminBackend\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AdminBackend\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::group(['middleware' => ['auth:admin', 'change.admindomain']], function () {
    Route::get('home', [AdminBackend\HomeController::class, 'index'])->name('home');
    Route::post('search', [AdminBackend\HomeController::class, 'search'])->name('search');

    Route::get('users', [AdminBackend\UsersController::class, 'index'])->name('users');
    Route::get('users/export', [AdminBackend\UsersController::class, 'export'])->name('users.export');
    Route::get('user/{id}', [AdminBackend\UsersController::class, 'get'])->name('user');
    Route::get('user/{id}/orders', [AdminBackend\UsersController::class, 'orders'])->name('user.orders');
    Route::get('user/{id}/ban', [AdminBackend\UsersController::class, 'ban'])->name('user.ban');

    Route::get('vendors', [AdminBackend\SellerController::class, 'index'])->name('vendors');
    Route::get('vendors/pending_approval', [AdminBackend\SellerController::class, 'pending'])->name('vendors.pending');
    Route::get('vendors/export', [AdminBackend\SellerController::class, 'export'])->name('vendors.export');
    Route::get('vendor/{id}', [AdminBackend\SellerController::class, 'get'])->name('vendor');
    Route::post('vendor/{id}/approval', [AdminBackend\SellerController::class, 'approval'])->name('vendor.approval');
    Route::get('vendor/{id}/products', [AdminBackend\SellerController::class, 'products'])->name('vendor.products');
    Route::get('vendor/{id}/subscriptions', [AdminBackend\SellerController::class, 'subscriptions'])->name('vendor.subscriptions');
    Route::get('vendor/{id}/ban', [AdminBackend\SellerController::class, 'ban'])->name('vendor.ban');

    Route::get('categories', [AdminBackend\CategoryController::class, 'index'])->name('categories');
    Route::get('categories/export', [AdminBackend\CategoryController::class, 'export'])->name('categories.export');
    Route::get('categories/new', [AdminBackend\CategoryController::class, 'new'])->name('category.new');
    Route::post('categories/new', [AdminBackend\CategoryController::class, 'newAdd'])->name('category.new.add');
    Route::get('category/{id}/edit', [AdminBackend\CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{id}/update', [AdminBackend\CategoryController::class, 'update'])->name('category.update');
    Route::get('category/{id}/trash', [AdminBackend\CategoryController::class, 'trash'])->name('category.trash');

    Route::get('attributes', [AdminBackend\AttributeController::class, 'index'])->name('attributes');
    //Route::get('attributes/export', [AdminBackend\CategoryController::class, 'export'])->name('categories.export');
    Route::get('attributes/new', [AdminBackend\AttributeController::class, 'new'])->name('attributes.new');
    Route::post('attributes/new', [AdminBackend\AttributeController::class, 'newAdd'])->name('attributes.new.add');
    Route::get('attribute/{id}/edit', [AdminBackend\AttributeController::class, 'edit'])->name('attribute.edit');
    Route::post('attribute/{id}/update', [AdminBackend\AttributeController::class, 'update'])->name('attribute.update');
    Route::get('attribute/{id}/trash', [AdminBackend\AttributeController::class, 'trash'])->name('attribute.trash');

    Route::get('products', [AdminBackend\ProductController::class, 'index'])->name('products');
    Route::get('products/export', [AdminBackend\ProductController::class, 'export'])->name('products.export');
    Route::get('product/{id}', [AdminBackend\ProductController::class, 'get'])->name('product');
    Route::get('product/{id}/trash', [AdminBackend\ProductController::class, 'trash'])->name('product.trash');
    Route::get('product/{id}/restore', [AdminBackend\ProductController::class, 'restore'])->name('product.restore');
    Route::get('product/{id}/reports', [AdminBackend\ProductController::class, 'abuseReports'])->name('product.reports');
    /*Route::get('product_new', [AdminBackend\ProductController::class, 'new'])->name('product.new');
    Route::post('product_new', [AdminBackend\ProductController::class, 'addNew']);
    Route::get('product/{id}/edit', [AdminBackend\ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/{id}/update', [AdminBackend\ProductController::class, 'update'])->name('product.update');*/

    Route::get('abuse_reports', [AdminBackend\AbuseReportController::class, 'index'])->name('abusereports');
    Route::get('abuse_report/{id}', [AdminBackend\AbuseReportController::class, 'get'])->name('abusereport');

    Route::get('orders', [AdminBackend\OrderController::class, 'index'])->name('orders');
    Route::get('orders/export', [AdminBackend\OrderController::class, 'export'])->name('orders.export');
    Route::get('order/{id}', [AdminBackend\OrderController::class, 'get'])->name('order');

    Route::get('subscriptions', [AdminBackend\SubscriptionController::class, 'index'])->name('subscriptions');
    #Route::get('orders/export', [AdminBackend\SubscriptionController::class, 'export'])->name('subscriptions.export');
    Route::post('subscriptions/activation', [AdminBackend\SubscriptionController::class, 'verifyPayment'])->name('subscriptions.activate');
    Route::get('subscription/{id}', [AdminBackend\SubscriptionController::class, 'get'])->name('subscription');

    Route::get('account/profile', [AdminBackend\ProfileController::class, 'index'])->name('profile');
    Route::put('account/profile/update', [AdminBackend\ProfileController::class, 'update'])->name('profile.update');
    Route::get('account/password', [AdminBackend\ProfileController::class, 'password'])->name('profile.password');
    Route::put('account/password', [AdminBackend\ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
        Route::get('/', [AdminBackend\SettingsController::class, 'index'])->name('home');
        Route::get('admin-details/{id}', [AdminBackend\SettingsController::class, 'viewAdmin'])->name('admin.get');
        Route::post('new-admin', [AdminBackend\SettingsController::class, 'newAdmin'])->name('admin.new');
        Route::post('update-admin/{id}', [AdminBackend\SettingsController::class, 'updateAdmin'])->name('admin.update');
        Route::post('update-admin/{id}/password', [AdminBackend\SettingsController::class, 'updateAdminPassword'])->name('admin.password');
        Route::get('delete-admin/{id}', [AdminBackend\SettingsController::class, 'deleteAdmin'])->name('admin.trash');
        Route::get('states-list', [AdminBackend\SettingsController::class, 'states'])->name('states');
        Route::get('city-list', [AdminBackend\SettingsController::class, 'cities'])->name('cities');
        Route::get('city/{id}', [AdminBackend\SettingsController::class, 'city'])->name('city');
        Route::post('city/{id}', [AdminBackend\SettingsController::class, 'newCity'])->name('city.new');
        Route::post('city/{id}/update', [AdminBackend\SettingsController::class, 'updateCity'])->name('city.update');
        Route::get('subscription-packages', [AdminBackend\SettingsController::class, 'subPacks'])->name('subpacks');
        Route::get('subscription-packages/{id}', [AdminBackend\SettingsController::class, 'subPack'])->name('subpack');
        Route::post('subscription-packages/{id}/update', [AdminBackend\SettingsController::class, 'subPackUpdate'])->name('subpack.update');
        Route::get('adverts', [AdminBackend\SettingsController::class, 'adverts'])->name('adverts');
        Route::get('advert/{id}', [AdminBackend\SettingsController::class, 'advert'])->name('advert');
        Route::post('advert/{id}/update', [AdminBackend\SettingsController::class, 'advertUpdate'])->name('advert.update');
        Route::get('plugview-newsroom', [AdminBackend\SettingsController::class, 'plugview'])->name('plugview');
        Route::post('plugview-newsroom', [AdminBackend\SettingsController::class, 'plugview'])->name('plugview.update');
    });

    Route::get('newsletter', [AdminBackend\NewsletterController::class, 'index'])->name('newsletter');
    Route::get('newsletter/export', [AdminBackend\NewsletterController::class, 'export'])->name('newsletter.export');
});