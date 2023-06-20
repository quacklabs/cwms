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
        
        Route::group(['middleware' => ['role:admin|manager|staff']], function () {
            Route::prefix('personnel')->group(function() {
                Route::group(['middleware' => 'role:admin|manager', 'as' => 'staff.'], function() {
                    Route::match(['get', 'post'],'staff', 'StaffController@staff')->name('staff');
                    Route::match(['get', 'post'], 'staff/{id}/{action}', 'StaffController@edit_staff')->middleware(['can:create-user'])->name('edit_staff');

                    Route::match(['get', 'post'], 'manager', 'StaffController@manager')->middleware('can:create-manager')->name('managers');
                    Route::match(['get','post'], 'edit-user/{id}', 'StaffController@edit_user')->middleware(['can:create-manager'])->name('edit_user');
                    Route::get('toggle-user/{id}/{action}', 'StaffController@toggle')->middleware(['role:admin|manager'])->name('toggle');
                    Route::get('delete-user/{id}', 'StaffController@delete_user')->middleware('can:delete-account')->name('delete_user');
                    // Route::match(['get','post'], '/modify-permissions/{id}', 'StaffController@permissions')->middleware(['can:grant-user-permission'])->name('modify_permissions');
                });
            });

            Route::prefix('access-control')->name('access.')->group(function() {
                Route::group(['middleware' => ['role:admin|manager']], function() {
                    Route::get('byRole', 'AccessController@role_permissions')->middleware('role:admin')->name('byRole');
                    Route::post('byRole/{role}', 'AccessController@role_permissions')->middleware('role:admin')->name('modifyByRole');
                    Route::match(['get', 'post'], 'byUser/{id}', 'AccessController@user_permissions')->middleware('role_or_permission:admin|manager|grant-user-permission')->name('byUser');
                });
            });


            Route::prefix('warehouse')->name('warehouse.')->group(function() {
                Route::match(['get', 'post'], 'warehouses', 'WarehouseController@index')->name('all_warehouses');
                Route::get('toggle/{id}/{action}', 'WarehouseController@toggle')->name('toggle');
                Route::match(['get', 'post'], 'edit/{id}', 'WarehouseController@edit')->name('edit');
                Route::get('delete/{id}', 'WarehouseController@delete')->name('delete');
                Route::get('view/{id}', 'WarehouseController@view')->name('view');
                Route::match(['get', 'post'], 'reassign-warehouse/{id}', 'WarehouseController@reassign')->middleware('can:reassign-manager')->name('reassign');
            });
            

            // Route::match(['get', 'post'], 'control', 'AccessController@control')
            // ->middleware(['can:grant-user-permission|grant-product-permission'])
            // ->name('control');
        });
    });

    Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
    Route::match(['get','post'], '/forgot', 'AuthController@forgot_password')->name('forgot_password');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
