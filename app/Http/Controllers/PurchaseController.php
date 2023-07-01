<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;

use App\Models\Supplier;
use App\Rules\DecimalComparison;


class PurchaseController extends Controller
{
    //

    protected function view(Request $request) {
        $transactions = TransactionService::getPurchases(Auth::user());
        $data = [
            'title' => 'View Purchases',
            'items' => $transactions,
            'flag' => 'purchase'
        ];
        return parent::render($data, 'transactions.view_transactions');
    }

    protected function create(Request $request) {

        if($request->method() == 'POST') {
            $valid = $request->validate([
                'partner_id' => ['required', 'numeric'],
                'warehouse_id' => ['required', 'numeric'],
                'date' => ['required', 'date'],
                'order' => ['required'],
                'discount_amount' => ['numeric', 'nullable'],
                'total_price' => ['required', 'decimal'],
                'invoice_no' => ['required']
            ]);
            
            $transaction = TransactionService::create($valid, 'purchase');
            if($transaction) {
                return redirect()->route('purchase.view')->with('success', 'order added successfully');
            }
        }
        $partners = Supplier::orderBy('created_at', 'desc')->where('status', true)->paginate(25);
        $data = [
            'title' => 'Add Purchase',
            'flag' => 'purchase',
            'action' => route('purchase.create'),
            'invoice_no' => TransactionService::newInvoice(),
            'partners' => $partners,
            'warehouses' => auth()->user()->warehouse->all()
        ];

        return parent::render($data, 'transactions.add_transaction');
    }

    public function receive(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('purchase.view');
        }

        $transaction = TransactionService::purchase($id);

        if(!$transaction) {
            return redirect()->route('purchase.view')->with('error', 'Unable to adjust payment. Invalid transaction');
        }

        if($request->method() == 'POST') {
            $valid = $request->validate([
                'amount' => ['required', 'decimal', new DecimalComparison('due')],
                'due' => ['required', 'decimal'],
            ]);

            $paid = str_replace(',','', $valid['amount']);
            $due = str_replace(',','', $valid['due']);
            $user = Auth::user();
            $transaction->paid_amount = $transaction->paid_amount + $paid;
            $transaction->save();
            return redirect()->route('purchase.view')->with('success', 'Payment processed successfully');
        }
    }

    public function returned(Request $request) {

        $data = [
            'title' => 'Returned Purchases',
            'flag' => 'purchase'
        ];


        return parent::render($data, 'transactions.reversed');
    }

    public function return_purchase(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('purchase.view');
        }
        $purchase = TransactionService::purchase($id);
        if(!$purchase) {
            return redirect()->route('purchase.view')->with('error', 'Invalid Transaction ID');
        }

        $data = [
            'title' => 'Return Purchase',
            'transaction' => $purchase,
            'flag' => 'purchase',
            'action' => route('purchase.return', ['id' => $id])
        ];

        if($request->method() == 'POST') {
            $valid = $request->validate([
                'order' => ['required'],
                'discount_amount' => ['numeric', 'nullable'],
                'date' => ['required', 'date'],
                'warehouse_id' => ['required', 'numeric'],
                'total_price' => ['required', 'decimal'],
                'notes' => ['string', 'nullable']
            ]);

            TransactionService::returnPurchase($valid, $purchase);
            return redirect()->route('purchase.returned')->with('success', 'Purchase returned successfully');
        }

        return parent::render($data, 'transactions.reverse');
    }
}
