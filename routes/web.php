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
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        
        Route::group(['middleware' => ['role:admin|manager']], function () {
            //
            Route::match(['get', 'post'],'staff', 'StaffController@staff')->name('staff');
            Route::match(['get', 'post'], 'manager', 'StaffController@manager')->middleware('can:create-manager')->name('managers');

            Route::match(['get', 'post'], 'control', 'AccessController@control')
            ->middleware(['can:grant-user-permission|grant-product-permission'])
            ->name('control');
        });
        
        
        
    });

    Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
    Route::match(['get','post'], '/forgot', 'AuthController@forgot_password')->name('forgot_password');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
