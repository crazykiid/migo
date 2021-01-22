<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {return view('index');});


Route::view('/create', 'create');
Route::post('/create', 'App\Http\Controllers\AccountController@userCreate');
Route::post('/login', 'App\Http\Controllers\AccountController@userLogin');
Route::get('/logout', 'App\Http\Controllers\AccountController@userLogout');