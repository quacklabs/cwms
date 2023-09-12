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

    Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
    Route::match(['get','post'], '/forgot', 'AuthController@forgot_password')->name('forgot_password');
    Route::get('/logout', 'AuthController@logout')->name('logout');

    Route::middleware(['auth'])->group(function () {
        // Define your routes here
       
        Route::group(['middleware' => ['role:admin|manager|staff']], function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::get('dashboard', 'DashboardController@index')->name('dashboard');

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
                Route::get('view-analytics/{id}', 'StoreController@view_analytics')->name('analytics');
                Route::get('view-inventory/{id}', 'StoreController@view_inventory')->name('inventory');
            });

            Route::prefix('partners')->name('partner.')->group(function() {
                Route::match(['get', 'post'], 'partners/{flag}', 'PartnersController@partners')->name('all');
                Route::get('view-partner/{flag}/{id}', 'PartnersController@view')->name('view');
                Route::get('toggle/{flag}/{id}/{action}', 'PartnersController@toggle')->middleware('permission:suspend-customer|suspend-supplier')->name('toggle');
                Route::get('delete/{flag}/{id}', 'PartnersController@delete')->middleware('permission:delete-customer|delete-supplier')->name('delete');
                Route::match(['get', 'post'], 'edit/{flag}/{id}', 'PartnersController@edit')->name('edit');
            });

            Route::prefix('purchase')->name('purchase.')->group(function() {
                Route::match(['get','post'], 'create', 'PurchaseController@create')->name('create');
                // Route::match(['get', 'post'], 'in-transit', 'PurchaseController@in_transit')->name('in_transit');
                Route::post('update/{id}', 'PurchaseController@update')->name('update');
                Route::get('view', 'PurchaseController@view')->name('view');
                Route::get('purchase/{id}', 'PurchaseController@view_single')->name('view_single');
                Route::get('returned', 'PurchaseController@returned')->name('returned');
                Route::get('delete/{id}', 'PurchaseController@delete')->middleware('permission:delete-purchase')->name('delete');
                Route::match(['get','post'], 'edit/{id}', 'PurchaseController@edit')->middleware('permisson:edit-purchase')->name('edit');
                Route::post('receive/{id}', 'PurchaseController@receive')->middleware('permission:approve-purchase-return')->name('receive');
                Route::match(['get', 'post'], 'return/{id}', 'PurchaseController@return_purchase')->middleware('permission:create-purchase-return')->name('return');
            });

            Route::prefix('transit')->name('transit.')->group(function() {
                Route::get('/', 'GoodsInTransitController@view')->name('view');
                Route::match(['get', 'post'], 'transfer/{product}', 'GoodsInTransitController@transfer')->name('transfer');
                Route::post('makeTransfer/{destination}', 'GoodsInTransitController@makeTransfer')->name('makeTransfer');
            });

            Route::prefix('sale')->name('sale.')->group(function() {
                Route::match(['get','post'], 'create', 'SalesController@create')->name('create');
                Route::get('view', 'SalesController@view')->name('view');
                Route::get('purchase/{id}', 'SalesController@view_single')->name('view_single');
                Route::get('returned', 'SalesController@returned')->name('returned');
                Route::post('payment/{id}', 'SalesController@payment')->name('payment');
                Route::post('return_payment/{id}', 'SalesController@return_payment')->name('return_payment');
                Route::post('receive/{id}', 'SalesController@receive')->middleware('permission:approve-sale')->name('receive');
                Route::get('delete/{id}', 'SalesController@delete')->middleware('permission:delete-sale')->name('delete');
                Route::match(['get', 'post'], 'return/{id}', 'SalesController@return_sale')->middleware('permission:create-sale-return')->name('return');
            });

            // Route::prefix('transactions')->name('transaction.')->group(function() {
            //     Route::match(['get','post'], 'add-transaction/{flag}', 'TransactionsController@create')->middleware('permission:create-purchase|create-sale')->name('create');
            //     Route::match(['get','post'], 'enter-ledger/{flag}/{id}', 'TransactionsController@enter_ledger')->middleware('permission:enter-ledger|approve-purchase|approve-sale')->name('enter_ledger');

            //     Route::get('transactions/{flag}', 'TransactionsController@view')->name('view');
            //     Route::get('toggle-transaction/{flag}/{switch}', 'TransactionController@toggle')->name('toggle');
            //     // Route::get('return-purchases', 'TransactionsController@return_purchases')->name('return_purchases');
            // });

            Route::prefix('stock')->name('stock.')->group(function() {
                Route::get('adjustments', 'StockController@adjustments')->middleware('permission:adjust-stock')->name('adjustments');
                Route::match(['get', 'post'],'make-adjustment', 'StockController@make_adjustment')->middleware('permission:adjust-stock')->name('make_adjustment');
                Route::match(['get', 'post'], 'adjustment/{id}', 'StockController@adjustment')->middleware('permission:edit-adjustment')->name('adjustment');
                Route::get('download-invoice/{id}', 'StockController@download_invoice')->name('download_invoice');
                Route::get('delete-adjustment/{id}', 'StockController@delete_adjustment')->middleware('permission:delete-adjustment')->name('delete_adjustment');
            });
            

            Route::prefix('transfer')->name('transfer.')->group(function() {
                Route::get('view/{flag}', 'TransferController@transfers')->middleware('permission:view-transfer')->name('view');
                Route::get('add/{flag}', 'TransferController@create_transfer')->middleware('permission:transfer-product')->name('add');
                Route::post('makeTransfer/{flag}/{destination}', 'TransferController@makeTransfer')->middleware('permission:transfer-product')->name('makeTransfer');
                // Route::match(['get', 'post'], 'transfer-stores', 'TransferController@stores_transfer')->middleware('permission:transfer-product')->name('stores');
                // Route::get('approve-transfer', )
            });

            Route::prefix('expenses')->name('expense.')->group(function() {
                Route::match(['get', 'post'], 'expense-types', 'ExpenseController@expense_types')->middleware('permission:create-expense-type')->name('types');
                Route::match(['get','post'],'expenses', 'ExpenseController@expenses')->name('expenses');
                Route::get('delete-expense/{id}', 'ExpenseController@delete')->middleware('permission:delete-expense')->name('delete');
                Route::get('delete-expense-type/{id}', 'ExpenseController@delete_type')->middleware('permission:delete-expense-type')->name('delete_type');
                Route::get('download-invoice', 'ExpenseController@download')->name('download');
            });

            Route::prefix('reports')->name('report.')->group(function() {
                // Route::middlea
                Route::get('supplier_payment', 'ReportsController@supplier_payment')->middleware('permission:view-payment-report')->name('supplier_payment');
                Route::get('customer_payment', 'ReportsController@customer_payment')->middleware('permission:view-payment-report')->name('customer_payment');
                Route::get('stock', 'ReportsController@stock_report')->middleware('permission:view-stock-report')->name('stock');
                Route::get('stock/byWarehouse', 'ReportsController@stock_byWarehouse')->middleware('permission:view-stock-report')->name('stock_byWarehouse');
                Route::get('stock/byProduct', 'ReportsController@stock_byProduct')->middleware('permission:view-stock-report')->name('stock_byProduct');
                Route::get('product_entry', 'ReportsController@product_entry')->name('product_entry');
                Route::get('customer_entry', 'ReportsController@customer_entry')->name('customer_entry');
                Route::get('supplier_entry', 'ReportsController@supplier_entry')->name('supplier_entry');
                Route::get('purchase_entry', 'ReportsController@purchase_entry')->name('purchase_entry');
                Route::get('purchase_return_entry', 'ReportsController@purchase_return_entry')->name('purchase_return_entry');
                Route::get('sale_entry', 'ReportsController@sale_entry')->name('sale_entry');
                Route::get('sale_return_entry', 'ReportsController@sale_return_entry')->name('sale_return_entry');
                Route::get('adjustment', 'ReportsController@adjustment')->name('adjustment');
                Route::get('transfer', 'ReportsController@transfer')->name('transfer');
                Route::get('expense', 'ReportsController@expense')->name('expense');
                Route::get('supplier_payment_entry', 'ReportsController@supplier_payment_entry')->middleware('permission:view-payment-report')->name('supplier_payment_entry');
                Route::get('customer_payment_entry', 'ReportsController@customer_payment_entry')->middleware('permission:view-payment-report')->name('customer_payment_entry');
            });

            Route::prefix('export')->name('export.')->group(function() {
                Route::get('export-transactions/{flag}/{start}/{end}/{format}', 'ExportsController@export_transactions')->name('export_details');
                Route::get('export-returns/{flag}/{start}/{end}/{format}', 'ExportsController@export_returns')->name('export_returns');
            });
        });
    });
});
