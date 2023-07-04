<?php

namespace App\Services;

use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Models\Sale;
use App\Models\SaleReturn;
use App\Models\Customer;
use App\Models\CustomerPayment;
use App\Models\Action;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Adjustment;
use App\Models\Transfer;
use App\Models\Expense;
// use 

class ReportService {
    
    public function getSupplierPaymentByWarehouse(int $id) {
        $payments = SupplierPayment::whereHas('transaction', function ($query) use ($id) {
            $query->where('warehouse_id', $id);
        })->paginate(25);
        return $payments;
    }

    public function getAllSupplierPayment() {
        return SupplierPayment::orderBy('created_at', 'desc')->paginate(25);
    }

    public function getAllCustomerPayment() {
        return CustomerPayment::orderBy('created_at', 'desc')->paginate(25);
    }

    public static function getCustomerPaymentByWarehouse(int $id) {
        $payments = CustomerPayment::whereHas('transaction', function ($query) use ($id) {
            $query->where('warehouse_id', $id);
        })->paginate(25);
        return $payments;
    }

    public static function getAllProductActions() {

    }

    public static function getProductActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Product::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    }   

    public static function getAllCustomerActions() {

    }

    public static function getCustomerActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Customer::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getAllSupplierActions() {

    }

    public static function getSupplierActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Supplier::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getAllPurchaseActions() {

    }

    public static function getPurchaseActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Purchase::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getAllPurchaseReturnActions() {

    }

    public static function getPurchaseReturnActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', PurchaseReturn::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getAllSaleActions() {

    }

    public static function getSaleActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Sale::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getAllSaleReturnActions() {

    }

    public static function getSaleReturnActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', SaleReturn::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getAdjustmentActions() {

    }

    public static function getAdjustmentActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Adjustment::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getTransferActions() {

    }

    public static function getTransferActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Transfer::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getExpenseActions() {

    }

    public static function getExpenseActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Expense::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getSupplierPaymentActions() {

    }

    public static function getSupplierPaymentActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', SupplierPayment::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 

    public static function getCustomerPaymentActions() {

    }

    public static function getCustomerPaymentActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', CustomerPayment::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(30);
        return $logs;
    } 
}