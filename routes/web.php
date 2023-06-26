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

            Route::prefix('product')->name('product.')->group(function() {
                Route::match(['get', 'post'], 'products', 'ProductsController@products')->name('products');
                Route::match(['get', 'post'], 'brands', 'ProductsController@brands')->name('brands');
                Route::match(['get', 'post'], 'categories', 'ProductsController@categories')->name('categories');
                Route::match(['get', 'post'], 'units', 'ProductsController@units')->name('units');
                Route::get('toggle/{type}/{id}/{action}', 'ProductsController@toggle')->middleware('role:admin|manager')->name('toggle');
                Route::match(['get', 'post'], 'delete/{type}/{id}', 'ProductsController@delete')->middleware('can:delete-category')->name('delete');
                Route::match(['get', 'post'], 'edit/{type}/{id}', 'ProductsController@edit')->middleware('can:edit-category')->name('edit');
            });

            Route::prefix('stores')->name('store.')->group(function() {
                Route::match(['get', 'post'], 'stores', 'StoreController@stores')->name('stores');
                Route::get('view-store/{id}', 'StoreController@view')->name('view');
                Route::get('toggle-store/{id}/{action}', 'StoreController@toggle')->name('toggle');
                Route::get('delete-store/{id}', 'StoreController@delete')->middleware('can:delete-store')->name('delete');
                Route::match(['get', 'post'], 'edit-store/{id}', 'StoreController@edit')->middleware('can:modify-store')->name('edit');
            });

            Route::prefix('partners')->name('partner.')->group(function() {
                Route::match(['get', 'post'], 'partners/{flag}', 'PartnersController@partners')->name('all');
                Route::get('view-partner/{flag}/{id}', 'PartnersController@view')->name('view');
                Route::get('toggle/{flag}/{id}/{action}', 'PartnersController@toggle')->middleware('permission:suspend-customer|suspend-supplier')->name('toggle');
                Route::get('delete/{flag}/{id}', 'PartnersController@delete')->middleware('permission:delete-customer|delete-supplier')->name('delete');
                Route::match(['get', 'post'], 'edit/{flag}/{id}', 'PartnersController@edit')->name('edit');
            });

            Route::prefix('transactions')->name('transaction.')->group(function() {
                Route::match(['get','post'], 'add-transaction/{flag}', 'TransactionsController@create')->middleware('permission:create-purchase|create-sale')->name('create');
                Route::match(['get','post'], 'enter-ledger/{flag}/{id}', 'TransactionsController@enter_ledger')->middleware('permission:enter-ledger|approve-purchase|approve-sale')->name('enter_ledger');

                Route::get('transactions/{flag}', 'TransactionsController@view')->name('view');
                Route::get('toggle-transaction/{flag}/{switch}', 'TransactionController@toggle')->name('toggle');
                // Route::get('return-purchases', 'TransactionsController@return_purchases')->name('return_purchases');
            });

            Route::prefix('stock')->name('stock.')->group(function() {
                Route::get('adjustments', 'StockController@adjustments')->middleware('permission:adjust-stock')->name('adjustments');
                Route::match(['get', 'post'],'make-adjustment', 'StockController@make_adjustment')->middleware('permission:adjust-stock')->name('make_adjustment');
                Route::match(['get', 'post'], 'adjustment/{id}', 'StockController@adjustment')->middleware('permission:edit-adjustment')->name('adjustment');
                Route::get('download-invoice/{id}', 'StockController@download_invoice')->name('download_invoice');
                Route::get('delete-adjustment/{id}', 'StockController@delete_adjustment')->middleware('permission:delete-adjustment')->name('delete_adjustment');
            });
            

            Route::prefix('transfer')->name('transfer.')->group(function() {
                Route::get('transfers', 'TransferController@transfers')->middleware('permission:view-transfer')->name('transfers');
                Route::match(['get', 'post'], 'create-transfer', 'TransferController@create_transfer')->middleware('permission:transfer-product')->name('create');
                // Route::get('approve-transfer', )
            });

            Route::prefix('expenses')->name('expense.')->group(function() {
                Route::match(['get', 'post'], 'expense-types', 'ExpenseController@expense_types')->middleware('permission:create-expense-type')->name('types');
                Route::match(['get','post'],'expenses', 'ExpenseController@expenses')->name('expenses');
                Route::get('delete-expense/{id}', 'ExpenseController@delete')->middleware('permission:delete-expense')->name('delete');
                Route::get('delete-expense-type/{id}', 'ExpenseController@delete_type')->middleware('permission:delete-expense-type')->name('delete_type');
                Route::get('download-invoice', 'ExpenseController@download')->name('download');
            });
        });
    });

    Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
    Route::match(['get','post'], '/forgot', 'AuthController@forgot_password')->name('forgot_password');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
