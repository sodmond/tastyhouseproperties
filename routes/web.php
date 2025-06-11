<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User as FrontendController;
use App\Mail\ApprovalStatus;
use App\Mail\SendAbuseReport;
use App\Mail\SendNewChatEmail;
use App\Mail\SendPasswordChange;
use App\Mail\SubscriptionConfirmation;
use App\Mail\SubscriptionReminder;
use App\Mail\WelcomeEmail;
use App\Models\AbuseReport;
use App\Models\Subscription;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => 'true']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\HomeController::class, 'contactForm']);
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get('/terms-conditions', [App\Http\Controllers\HomeController::class, 'tandc'])->name('tandc');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacypolicy');
Route::get('/get-state-city/{state_id}', [App\Http\Controllers\HomeController::class, 'getCitiesforState']);
Route::get('/get-sub-categories/{cat_id}', [App\Http\Controllers\HomeController::class, 'getSubCategories']);
Route::get('/advertise', [App\Http\Controllers\HomeController::class, 'advertise'])->name('advertise');
Route::post('/advertise', [App\Http\Controllers\HomeController::class, 'advertiseForm']);
Route::post('/newsletter-subscription', [App\Http\Controllers\HomeController::class, 'newsletter'])->name('newsletter');

Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/shop/prime', [App\Http\Controllers\ShopController::class, 'prime'])->name('shop.prime');
Route::get('/shop/category/{id}/{slug}', [App\Http\Controllers\ShopController::class, 'category'])->name('shop.category');
Route::get('/product/{slug}', [App\Http\Controllers\ShopController::class, 'view'])->name('product');
Route::post('/product/{id}/report', [App\Http\Controllers\ShopController::class, 'abuseReport'])->name('product.report')->middleware('auth:web');
Route::get('/search', [App\Http\Controllers\ShopController::class, 'search'])->name('shop.search');
Route::get('/change-user-location', [App\Http\Controllers\ShopController::class, 'changeLocation']);
Route::get('/reset-location', [App\Http\Controllers\ShopController::class, 'resetLocation']);

Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog-details/{id}/{slug}', [App\Http\Controllers\BlogController::class, 'view'])->name('blog.details');

Route::get('/all-vendors', [App\Http\Controllers\VendorController::class, 'index'])->name('sellers');
Route::get('/become-a-vendor', [App\Http\Controllers\VendorController::class, 'about'])->name('seller.about');
Route::get('/vendor-details', [App\Http\Controllers\VendorController::class, 'view'])->name('seller.details');
Route::get('/vendor-reviews', [App\Http\Controllers\VendorController::class, 'reviews'])->name('vendor.reviews');

Route::group(['middleware' => ['auth:web', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('home', [FrontendController\HomeController::class, 'index'])->name('home');
    
    Route::get('wishlist', [FrontendController\WishlistController::class, 'index'])->name('wishlist');
    Route::post('wishlist/add', [FrontendController\WishlistController::class, 'addItem'])->name('wishlist.add');
    Route::post('wishlist/remove', [FrontendController\WishlistController::class, 'removeItem'])->name('wishlist.remove');

    Route::get('messages', [FrontendController\ChatController::class, 'index'])->name('messages');
    Route::post('messages/initiate', [FrontendController\ChatController::class, 'initiateChat'])->name('messages.initiate');
    Route::get('message/{id}', [FrontendController\ChatController::class, 'chat'])->name('message');
    Route::post('message/{id}', [FrontendController\ChatController::class, 'sendMessage'])->name('message.send');

    Route::get('reviews', [FrontendController\ReviewController::class, 'index'])->name('reviews');
    Route::get('reviews/new', [FrontendController\ReviewController::class, 'new'])->name('reviews.new');
    Route::post('reviews/new', [FrontendController\ReviewController::class, 'addNew']);
    Route::get('review/{id}', [FrontendController\ReviewController::class, 'get'])->name('review');

    Route::get('profile', [FrontendController\ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [FrontendController\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [FrontendController\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/update/image', [FrontendController\ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::get('profile/password', [FrontendController\ProfileController::class, 'password'])->name('profile.password');
    Route::put('profile/password', [FrontendController\ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    Route::get('settings', [FrontendController\SettingsController::class, 'index'])->name('settings');
});

/*Route::domain('tastyhousestore')->group(function(){
    //
});

Route::domain('tastyhouseclub')->group(function(){
    Route::get('/', [FrontendController\HomeController::class, 'index'])->name('home');
});*/

Route::get('/mailable', function() {
    return new SubscriptionReminder('', 'prime', 0);
    #$report = AbuseReport::first();
    #return new SendAbuseReport($report);
    #return new SendNewChatEmail('Alex', 'vendor');
    #$sub = Subscription::first();
    #return new SubscriptionConfirmation($sub);
    #return new WelcomeEmail('Tunde');
    #return new SendPasswordChange('Mark');
    #return new ApprovalStatus(1);
    #return new SendOrderConfirmation(1, 'ORD373764474');
});