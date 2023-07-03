<?php

namespace App\Services;

use App\Models\SupplierPayment;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\CustomerPayment;
use App\Models\Action;
use App\Models\Warehouse;
use App\Models\Product;

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
            ->paginate(100);
        return $logs;
    }   

    public static function getAllCustomerActions() {

    }

    public static function getCustomerActionsByWarehouse($id) {
        $staff = Warehouse::find($id)->staff()->get()->pluck('id')->flatten()->all();
        $logs = Action::where('model_type', Product::class)->with('model')
            ->whereIn('user_id', $staff)
            ->paginate(100);
        return $logs;
    } 
}