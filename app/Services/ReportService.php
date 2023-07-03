<?php

namespace App\Services;

use App\Models\SupplierPayment;
use App\Models\Purchase;

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
}