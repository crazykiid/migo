<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function(){return view('index');});

Route::view('/about', 'about');
Route::view('/cart', 'cart');

Route::group(['middleware' => 'redirect'], function(){

	Route::view('/create', 'create');
	Route::post('/create', 'App\Http\Controllers\AccountController@userCreate');

	Route::view('/login', 'login');
	Route::post('/login', 'App\Http\Controllers\AccountController@userLogin');

	Route::get('/logout', 'App\Http\Controllers\AccountController@userLogout');
});

Route::get('/product/{id}', 'App\Http\Controllers\ProductController@viewProduct');

Route::post('/cart/pick', 'App\Http\Controllers\CartController@addProduct');
Route::post('/cart/drop', 'App\Http\Controllers\CartController@removeProduct');