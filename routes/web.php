<?php

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

Route::group(['namespace' => 'Admin'], function() {
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::get('cart', 'CartController@getCart')->name('cart')->middleware('auth');
    Route::get('add-to-cart/{id}', 'CartController@addToCart')->name('addcart');
    Route::patch('update-cart/{id}', 'CartController@update')->name('updatecart');
    Route::delete('remove-from-cart/{id}', 'CartController@remove')->name('removecart');
    Route::resource('order', 'OrderController');
    Route::get('order-detail/{id}', 'OrderDetailController@getOrderDetail')->name('order.detail');
    Route::post('add-cart/{id}', 'CartController@addCart')->name('product.cart');
    Route::resource('suggest-admin', 'SuggestController');
});

Route::group(['namespace' => 'Client'], function() {
    Route::get('/', 'PageController@getIndex')->name('index');
    Route::get('about', 'PageController@getAbout')->name('about');
    Route::get('contact', 'PageController@getContact')->name('contact');
    Route::get('product-detail/{id}', 'ProductDetailController@getProductDetail')->name('product.detail');
    Route::get('categories/{id}', 'CategoryController@getCategory')->name('category');
    Route::post('checkout', 'CheckoutController@checkoutCart')->name('checkout');
    Route::get('profile-user/{id}', 'UserController@profileUser')->name('profileuser');
    Route::get('edit-user/{id}', 'UserController@editUser')->name('edituser');
    Route::patch('edit-user/{id}', 'UserController@updateUser')->name('updateUser');
    Route::get('suggest', 'UserController@getSuggest')->name('suggest');
    Route::post('suggest', 'UserController@postSuggest')->name('create.suggest');
    Route::get('history-order', 'OrderController@getHistoryOrder')->name('history.order');
    Route::get('history-order-detail/{id}', 'OrderController@getHistoryOrderDetail')->name('history.order.detail');
    Route::post('rate/{id}', 'RateController@postRate')->name('rate')->middleware('auth');
    Route::get('search', 'SearchController@getSearch')->name('search');
});

Auth::routes();
