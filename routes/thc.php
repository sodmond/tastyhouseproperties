<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\THC as THCController;
use App\Mail\ApprovalStatus;
use App\Mail\NewOrder;
use App\Mail\SendAbuseReport;
use App\Mail\SendNewChatEmail;
use App\Mail\SendPasswordChange;
use App\Mail\SubscriptionConfirmation;
use App\Mail\SubscriptionReminder;
use App\Mail\WelcomeEmail;
use App\Models\AbuseReport;
use App\Models\Chat;
use App\Models\Order;
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

Route::get('/', [THCController\HomeController::class, 'index'])->name('home');
#Route::get('/about-us', [THCController\HomeController::class, 'about'])->name('about');
#Route::get('/contact', [THCController\HomeController::class, 'contact'])->name('contact');
#Route::post('/contact', [THCController\HomeController::class, 'contactForm']);
#Route::get('/faq', [THCController\HomeController::class, 'faq'])->name('faq');
#Route::get('/terms-conditions', [THCController\HomeController::class, 'tandc'])->name('tandc');
#Route::get('/privacy-policy', [THCController\HomeController::class, 'privacyPolicy'])->name('privacypolicy');
Route::get('/get-state-city/{state_id}', [THCController\HomeController::class, 'getCitiesforState']);
Route::get('/get-sub-categories/{cat_id}', [THCController\HomeController::class, 'getSubCategories']);
Route::get('/advertise', [THCController\HomeController::class, 'advertise'])->name('advertise');
Route::post('/advertise', [THCController\HomeController::class, 'advertiseForm']);
Route::post('/newsletter-subscription', [THCController\HomeController::class, 'newsletter'])->name('newsletter');

Route::get('/shop', [THCController\ShopController::class, 'index'])->name('shop');
Route::get('/shop/prime', [THCController\ShopController::class, 'prime'])->name('shop.prime');
Route::get('/shop/category/{id}/{slug}', [THCController\ShopController::class, 'category'])->name('shop.category');
Route::get('/product/{slug}', [THCController\ShopController::class, 'view'])->name('product');
Route::post('/product/{id}/report', [THCController\ShopController::class, 'abuseReport'])->name('product.report')->middleware('auth:web');
Route::get('/search', [THCController\ShopController::class, 'search'])->name('shop.search');
Route::get('/change-user-location', [THCController\ShopController::class, 'changeLocation']);
Route::get('/reset-location', [THCController\ShopController::class, 'resetLocation']);

Route::get('/all-vendors', [THCController\VendorController::class, 'index'])->name('sellers');
Route::get('/become-a-vendor', [THCController\VendorController::class, 'about'])->name('seller.about');
Route::get('/vendor-details', [THCController\VendorController::class, 'view'])->name('seller.details');
Route::get('/vendor-reviews', [THCController\VendorController::class, 'reviews'])->name('vendor.reviews');

Route::get('/cart', [THCController\CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [THCController\CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [THCController\CartController::class, 'removeItem'])->name('cart.remove');
Route::get('/checkout', [THCController\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [THCController\CheckoutController::class, 'checkout'])->name('checkout.submit');

Route::group(['middleware' => ['auth:web', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('home', [THCController\User\HomeController::class, 'index'])->name('home');
    
    Route::get('wishlist', [THCController\User\WishlistController::class, 'index'])->name('wishlist');
    Route::post('wishlist/add', [THCController\User\WishlistController::class, 'addItem'])->name('wishlist.add');
    Route::post('wishlist/remove', [THCController\User\WishlistController::class, 'removeItem'])->name('wishlist.remove');

    Route::get('messages', [THCController\User\ChatController::class, 'index'])->name('messages');
    Route::post('messages/initiate', [THCController\User\ChatController::class, 'initiateChat'])->name('messages.initiate');
    Route::get('message/{id}', [THCController\User\ChatController::class, 'chat'])->name('message');
    Route::post('message/{id}', [THCController\User\ChatController::class, 'sendMessage'])->name('message.send');

    Route::get('reviews', [THCController\User\ReviewController::class, 'index'])->name('reviews');
    Route::get('reviews/new', [THCController\User\ReviewController::class, 'new'])->name('reviews.new');
    Route::post('reviews/new', [THCController\User\ReviewController::class, 'addNew']);
    Route::get('review/{id}', [THCController\User\ReviewController::class, 'get'])->name('review');

    Route::get('orders', [THCController\User\OrderController::class, 'index'])->name('orders');
    Route::get('order/{id}', [THCController\User\OrderController::class, 'get'])->name('order');

    Route::get('profile', [THCController\User\ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [THCController\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [THCController\User\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/update/image', [THCController\User\ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::get('profile/password', [THCController\User\ProfileController::class, 'password'])->name('profile.password');
    Route::put('profile/password', [THCController\User\ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    #Route::get('settings', [THCController\User\SettingsController::class, 'index'])->name('settings');
});

Route::get('/mailable', function() {
    $order = Order::find(13);
    $chat = Chat::where('order_id', $order->id)->first();
    return new NewOrder($order, $chat);
    #return new SubscriptionReminder('', 'prime', 0);
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