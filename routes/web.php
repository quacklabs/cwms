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

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::middleware(['auth'])->group(function () {
        // Define your routes here

        
    });

    Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
    Route::match(['get','post'], '/forgot', 'AuthController@forgot_password')->name('forgot_password');
});
