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
    Route::resource('image', 'ImageController');
    Route::resource('category', 'CategoryController');
});


Route::group(['namespace' => 'Client'], function() {
    Route::get('/', 'PageController@getIndex')->name('index');
    Route::get('about', 'PageController@getAbout')->name('about');
    Route::get('contact', 'PageController@getContact')->name('contact');
});
