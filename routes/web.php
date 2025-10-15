<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('product.index');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('product.index');
})->name('home');

Route::group(['prefix' => 'shop', 'as' => 'product.'], function() {
    Route::get('index', 'ProductController@index')->name('index');
    Route::get('c/{taxonomyName}/{taxon}', 'ProductController@index')->name('category');
    Route::get('p/{slug}', 'ProductController@show')->name('show');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {
    Route::get('show', 'CartController@show')->name('show');
    Route::post('add/{product}', 'CartController@add')->name('add');
    Route::post('adv/{masterProductVariant}', 'CartController@addVariant')->name('add-variant');
    Route::post('update/{cart_item}', 'CartController@update')->name('update');
    Route::post('remove/{cart_item}', 'CartController@remove')->name('remove');
});

Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function() {
    Route::get('show', 'CheckoutController@show')->name('show');
    Route::post('submit', 'CheckoutController@submit')->name('submit');
});

Route::group(['prefix' => 'payment/eup', 'as' => 'payment.euplatesc.return.'], function() {
    Route::post('frontend', 'EuplatescReturnController@frontend')->name('frontend');
    Route::post('silent', 'EuplatescReturnController@silent')->name('silent');
});

Route::group(['prefix' => 'payment/netopia', 'as' => 'payment.netopia.'], function() {
    Route::post('confirm', 'NetopiaReturnController@confirm')->name('confirm');
    Route::get('return', 'NetopiaReturnController@return')->name('return');
});

Route::group(['prefix' => 'payment/paypal', 'as' => 'payment.paypal.'], function() {
    Route::get('return', 'PaypalReturnController@return')->name('return');
    Route::get('cancel', 'PaypalReturnController@cancel')->name('cancel');
    Route::any('webhook', 'PaypalReturnController@webhook')->name('webhook');
});

Route::group(['prefix' => 'payment/simplepay', 'as' => 'payment.simplepay.'], function() {
    Route::get('return', 'SimplepayReturnController@return')->name('return');
    Route::post('silent', 'SimplepayReturnController@silent')->name('silent');
});

Route::group(['prefix' => 'payment/mollie', 'as' => 'payment.mollie.'], function() {
    Route::get('{paymentId}/return', 'MollieController@return')->name('return');
    Route::post('webhook', 'MollieController@webhook')->name('webhook');
});

Route::group(['prefix' => 'payment/adyen', 'as' => 'payment.adyen.'], function() {
    Route::post('{paymentId}/submit', 'AdyenController@submit')->name('submit');
    Route::post('webhook', 'AdyenController@webhook')->name('webhook');
});

Route::group(['prefix' => 'payment/braintree', 'as' => 'payment.braintree.'], function() {
    Route::post('{paymentId}/submit', 'BraintreeController@submit')->name('submit');
});

Route::group(['prefix' => 'payment/stripe', 'as' => 'payment.stripe.'], function() {
    Route::post('webhook', 'StripeReturnController@webhook');
});

// UMKM Registration Routes
Route::group(['prefix' => 'umkm', 'as' => 'umkm.'], function() {
    Route::get('register', 'UmkmRegistrationController@showRegistrationForm')->name('register.show');
    Route::post('register', 'UmkmRegistrationController@register')->name('register');
    Route::post('check-email', 'UmkmRegistrationController@checkEmail')->name('check-email');
});

// Buyer Registration Routes
Route::group(['prefix' => 'buyer', 'as' => 'buyer.'], function() {
    Route::get('register', 'BuyerRegistrationController@showRegistrationForm')->name('register.show');
    Route::post('register', 'BuyerRegistrationController@register')->name('register');
    Route::post('check-email', 'BuyerRegistrationController@checkEmail')->name('check-email');
});

// Buyer Profile Routes
Route::group(['prefix' => 'buyer', 'as' => 'buyer.', 'middleware' => 'auth'], function() {
    Route::get('profile', 'BuyerProfileController@show')->name('profile.show');
    Route::put('profile', 'BuyerProfileController@update')->name('profile.update');
});

// Merchant Routes
Route::group(['prefix' => 'merchant', 'as' => 'merchant.'], function() {
    Route::get('profile', 'MerchantController@profile')->name('profile');
    Route::put('profile', 'MerchantController@updateProfile')->name('profile.update');
});

// Order Routes
Route::group(['prefix' => 'orders', 'as' => 'order.'], function() {
    Route::get('/', 'OrderController@index')->name('index');
    Route::get('/{order}', 'OrderController@show')->name('show');
});

// Notification Routes
Route::group(['prefix' => 'notifications', 'as' => 'notifications.', 'middleware' => 'auth'], function() {
    Route::post('{id}/mark-as-read', 'NotificationController@markAsRead')->name('mark-as-read');
    Route::post('mark-all-as-read', 'NotificationController@markAllAsRead')->name('mark-all-as-read');
    Route::get('unread-count', 'NotificationController@getUnreadCount')->name('unread-count');
    Route::get('recent', 'NotificationController@getRecent')->name('recent');
});