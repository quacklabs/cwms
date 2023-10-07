<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\StockCreationStarted;

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
        Route::post('findProductInWarehouse', 'APIController@findProductInWarehouse')->name('findProductInWarehouse');
        Route::post('findPartner/{flag}', 'APIController@partners')->name('findPartner');
        Route::post('uploadSerial', 'APIController@parse_serials')->name('uploadSerials');
        Route::post('findStore', 'APIController@stores')->name('findStore');
        Route::post('find-product', 'APIController@productsInGIT')->name('findProductInTransit');
        Route::get('my-jobs', 'APIController@myRunningJobs')->name('queue');
        Route::get('test', function () {
            event(new StockCreationStarted('Someone'));
            return response()->json(["Event has been sent!"]);
        });
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

