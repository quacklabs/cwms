<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'App\Http\Controllers'], function() {
    // Route::middleware('auth:api')->name('api.')->group(function () {
    Route::group(['as' => 'api.'],function () {
        Route::post('/managers', 'APIController@managers')->name('managers');
        Route::post('findWarehouse', 'APIController@warehouses')->name('findWarehouse');
        Route::post('findProduct', 'APIController@products')->name('findProduct');
        Route::post('findProductByWarehouse/{id}', 'APIController@productsByWarehouse')->name('findProductByWarehouse');
        // Route::post('productsInWarehouse', 'APIController@productsInWarehouse')->name('findProductInWarehouse');
        Route::post('findPartner/{flag}', 'APIController@partners')->name('findPartner');
        Route::post('uploadSerial', 'APIController@parse_serials')->name('uploadSerials');
    });
});


// Route::middleware('auth:sanctum')->name('api.')->group(function () {
//     Route::group(['namespace' => 'App\Http\Controllers'], function() {
//     // Route::group(['as' => 'api.'],function () {
//         Route::post('/managers', 'APIController@managers')->name('managers');
//         Route::post('findWarehouse', 'APIController@warehouses')->name('findWarehouse');
//         Route::post('findProduct', 'APIController@products')->name('findProduct');
//         Route::post('findPartner/{flag}', 'APIController@partners')->name('findPartner');
//     });
// });

