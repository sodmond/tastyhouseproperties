<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller as SellerBackend;

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

Route::group([], function(){
    Route::get('register', [SellerBackend\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [SellerBackend\Auth\RegisterController::class, 'register']);
    Route::get('email/verify', [SellerBackend\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::post('email/verify', [SellerBackend\Auth\VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('email/verify/{id}/{hash}', [SellerBackend\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('login', [SellerBackend\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [SellerBackend\Auth\LoginController::class, 'login']);
    Route::post('logout', [SellerBackend\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('password/confirm', [SellerBackend\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [SellerBackend\Auth\ConfirmPasswordController::class, 'confirm']);
    Route::get('password/reset', [SellerBackend\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [SellerBackend\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [SellerBackend\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [SellerBackend\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::group(['middleware' => ['auth:seller', 'verified', 'seller.type']], function () {
    Route::get('/', [SellerBackend\HomeController::class, 'home']);
    Route::get('home', [SellerBackend\HomeController::class, 'index'])->name('home');
    Route::post('request_approval', [SellerBackend\HomeController::class, 'requestApproval'])->name('approval');
    Route::get('payment-verify', [SellerBackend\PaymentController::class, 'handleGatewayCallback'])->name('payment.verify');

    Route::get('products', [SellerBackend\ProductController::class, 'index'])->name('products');
    Route::get('product-new', [SellerBackend\ProductController::class, 'new'])->name('product.new');
    Route::post('product-new', [SellerBackend\ProductController::class, 'addNew']);
    Route::get('product/{id}/edit', [SellerBackend\ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/{id}/update', [SellerBackend\ProductController::class, 'update'])->name('product.update');
    Route::post('book/{id}/update-image', [SellerBackend\ProductController::class, 'updateImage'])->name('product.update.image');
    Route::get('product/{id}/trash', [SellerBackend\ProductController::class, 'trash'])->name('product.trash');
    Route::get('product-tags', [SellerBackend\ProductController::class, 'tags'])->name('product.tags');
    Route::post('product/delete', [SellerBackend\ProductController::class, 'trash'])->name('product.delete');
    Route::post('product/prime', [SellerBackend\ProductController::class, 'setPrime'])->name('product.prime');

    Route::get('messages', [SellerBackend\ChatController::class, 'index'])->name('messages');
    Route::get('message/{id}', [SellerBackend\ChatController::class, 'chat'])->name('message');
    Route::post('message/{id}', [SellerBackend\ChatController::class, 'sendMessage'])->name('message.send');

    Route::get('reviews', [SellerBackend\ReviewController::class, 'index'])->name('reviews');
    Route::get('review/{id}', [SellerBackend\ReviewController::class, 'get'])->name('review');

    Route::get('profile', [SellerBackend\ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [SellerBackend\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [SellerBackend\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/update/image', [SellerBackend\ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::get('profile/password', [SellerBackend\ProfileController::class, 'password'])->name('profile.password');
    Route::put('profile/password', [SellerBackend\ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    Route::post('profile/verify-nin', [SellerBackend\ProfileController::class, 'verifyNin'])->name('profile.verify');

    Route::get('settings', [SellerBackend\SettingsController::class, 'index'])->name('settings');
    Route::post('settings/subscribe', [SellerBackend\SettingsController::class, 'subscribe'])->name('settings.subscribe');
    Route::get('settings/subscriptions', [SellerBackend\SettingsController::class, 'subscriptions'])->name('subscriptions');
    Route::post('settings/prime-product', [SellerBackend\SettingsController::class, 'primeProduct'])->name('prime.product');
});