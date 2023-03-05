<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('register', 'Auth\RegisterController@registerPage')->name('register');
    Route::post('register-user', 'Auth\RegisterController@register_user')->name('register-user');


    Route::middleware('auth')->group(function () {
        Route::get('shop-home', 'HomeController@shopindex')->name('shop-home');
        Route::get('product-add', 'ProductController@add_product')->name('product-add');
        Route::post('save-product', 'ProductController@save_product')->name('save-product');

        Route::get('cart-store', 'CartController@add')->name('cart-store');
        Route::get('cart-view', 'CartController@cart_view')->name('cart-view');
        Route::get('cart-update', 'CartController@cart_update')->name('cart-update');
        Route::get('remove-cart/{id?}', 'CartController@remove_cart')->name('remove-cart');

        Route::get('product-view/{id?}', 'ProductController@product_view')->name('product-view');
    
    });




});


