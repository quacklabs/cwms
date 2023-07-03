<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ReportService;

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

        // dd($payments);

        $data = [
            'title' => 'Supplier Payments',
            'flag' => 'supplier',
            'payments' => $payments
        ];

        return parent::render($data, 'reports.payments');
    }
}
