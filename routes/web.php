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

// Users - Product
Route::get('/', 'UsersController@home');
Route::get('/products', 'UsersController@allProduct');
Route::get('/product/{id}', 'UsersController@product');

Route::get('/login', 'UsersController@login');
Route::get('/register', 'UsersController@register');

Route::post('/register/process', 'UsersController@registerProcess');
Route::post('/login/process', 'UsersController@loginProcess');

Route::get('/logout', 'UsersController@logout');

// Category
Route::get('/category/{category}', 'UsersController@categoryProduct');

// Buyers 
Route::post('/addtocart', 'BuyersController@addToCart');
Route::get('/cart/{id}', 'BuyersController@cart');

Route::post('/editcart', 'BuyersController@editCart');
Route::get('/deletecart/{id}', 'BuyersController@deleteCart');

Route::get('/checkout', 'BuyersController@checkout');

// Supplier
Route::get('/supplier/{id}', 'SupplierController@detailSupplier');