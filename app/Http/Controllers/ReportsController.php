<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ReportService;
use App\Services\StockService;

use App\Models\Warehouse;

class ReportsController extends Controller
{
    //
    public function supplier_payment(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $payments = ReportService::getAllSupplierPayment();
        } else {
            $payments = ReportService::getSupplierPaymentByWarehouse($user->warehouse->first()->id);
        }
        $data = [
            'title' => 'Supplier Payments',
            'flag' => 'supplier',
            'payments' => $payments
        ];

        return parent::render($data, 'reports.payments');
    }

    public function customer_payment(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $payments = ReportService::getAllCustomerPayment();
        } else {
            $payments = ReportService::getCustomerPaymentByWarehouse($user->warehouse->first()->id);
        }

        // dd($payments);

        $data = [
            'title' => 'Customer Payments',
            'flag' => 'customer',
            'payments' => $payments
        ];

        return parent::render($data, 'reports.payments');
    }

    public function stock_report(Request $request) {
        $user = Auth::user();

        $warehouse_id = $request->input('warehouse');
        $product_id = $request->input('product');

        if($warehouse_id != null && $warehouse_id != "") {
            $stock = StockService::getStockByWarehouse($warehouse_id);
        } else if($product_id != null && $product_id != "") {
            $stock = StockService::getStockByProduct($product_id, $user->warehouse->first()->id);
        } else {
            if($user->hasRole('admin') || $user->hasRole('sub-admin')) {
                $stock = StockService::getAllProductStock();
            } else {
                $stock = StockService::getStockByWarehouse($user->warehouse->first()->id);
            }
        }


        $data = [
            'title' => 'Stock Report',
            'flag' => 'customer',
            'stock' => $stock,
            'warehouses' => Warehouse::orderBy('created_at', 'desc')->take(10)->get()
        ];

        return parent::render($data, 'reports.stock');
    }

    public function product_entry(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $actions = ReportService::getAllProductActions();
        } else {
            $actions = ReportService::getProductActionsByWarehouse($user->warehouse->first()->id);
        }

        $data = [
            'title' => 'Product Data Entry',
            'actions' => $actions
        ];

        return parent::render($data, 'reports.entry.product');
    }

    public function customer_entry(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $actions = ReportService::getAllCustomerActions();
        } else {
            $actions = ReportService::getCustomerActionsByWarehouse($user->warehouse->first()->id);
        }

        $data = [
            'title' => 'Customer Entry Reports',
            'actions' => $actions
        ];

        return parent::render($data, 'reports.entry.customer');
    }
}
