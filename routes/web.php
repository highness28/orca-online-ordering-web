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

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products', 'ProductsController@index');

Route::get('/product', 'ProductController@index');
Route::get('/add-cart', 'ProductController@addCart');
Route::get('/update-cart', 'ProductController@updateCart');
Route::get('/cart', 'ProductController@getCart');
Route::get('/cart-total', 'ProductController@getCartTotal');
Route::get('/cart-qty', 'ProductController@getCartQuantity');
Route::get('/cart-remove', 'ProductController@removeCart');
Route::get('/checkout', 'ProductController@checkout')->middleware('verified');
Route::post('/payment', 'ProductController@payment');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');