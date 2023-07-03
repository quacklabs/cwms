<?php

namespace App\Services;

use App\Models\SupplierPayment;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\CustomerPayment;

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

    public function getCustomerPaymentByWarehouse(int $id) {
        $payments = CustomerPayment::whereHas('transaction', function ($query) use ($id) {
            $query->where('warehouse_id', $id);
        })->paginate(25);
        return $payments;
    }
}