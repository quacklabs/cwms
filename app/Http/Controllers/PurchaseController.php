<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Event;

use App\Rules\Decimal;

use App\Services\TransactionService;
use App\Events\SupplierPaymentReceived;


use App\Models\Supplier;
use App\Models\Warehouse;
use App\Rules\DecimalComparison;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    //

    protected function view(Request $request) {
        $user = Auth::user();
        $range = request('dateRange');
        $invoice = request('invoice');
        if(isset($range)) {
            $transactions = TransactionService::getPurchasesByRange($user, $range);
        } else if(isset($invoice)) {
            $transactions = TransactionService::getPurchasesByInvoice($user, $invoice);
        } else {
            $transactions = TransactionService::getPurchases($user);
        }
        
        $data = [
            'title' => 'View Purchases',
            'items' => $transactions,
            'flag' => 'purchase'
        ];
        return parent::render($data, 'transactions.view_purchase');
    }

    public function update(Request $request) {
       
        $id = $request->route('id');
        if(!$id) { return redirect()->route('purchase.view')->with('error', 'Unable to update purchase'); }

        $validate = Validator::make($request->all(), [
            'status' => ['required'],
            'order_details' => ['nullable'],
        ]);

        // dd($validate->validated());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            $service = new TransactionService();
            $service->updatePurchase($id, $validate->validated());
            return redirect()->route('purchase.view')->with('success', 'Purchase Status Updated');
        }
    }

    public function view_single(Request $request) {
        $id = $request->route('id');
        if($id == NULL) {
            return redirect()->route('purchase.view');
        }
        $transaction = TransactionService::getPurchase($id);
        $data = [
            'title' => 'View Purchase',
            'transaction' => $transaction,
        ];
        return parent::render($data, 'transactions.view_single_purchase');
    }

    // public function in_transit(Request $request) {
    //     $user = Auth::user();
    //     if($request->method() == 'POST') {

    //     }
    //     $transactions = TransactionService::getInTransit($user);

    //     $data = [
    //         "title" => "Goods In Transit",
    //         "transactions" => $transactions
    //     ];

    //     return parent::render($data, 'transactions.view_transit');
    // }

    public function create(Request $request) {
        $user = Auth::user();
        if($request->method() == 'POST') {
            $valid = $request->validate([
                'partner_id' => ['required', 'numeric'],
                'date' => ['required', 'date'],
                'order' => ['required'],
                'discount_amount' => ['numeric', 'nullable'],
                'total_price' => ['required', 'decimal'],
                'invoice_no' => ['required'],
                'order_status' => ['required']
            ]);
            $transaction = TransactionService::createPurchase($valid);
            if($transaction == NULL) {
                return redirect()->route('purchase.create')->with("error", "Order could not be created: an unknown error occured");
            }
           return redirect()->route('purchase.view')->with('success', 'order added successfully');
        }
        $partners = Supplier::orderBy('created_at', 'desc')->where('status', true)->paginate(25);
        if($user->hasRole('admin')) {
            $warehouses = Warehouse::orderBy('created_at', 'asc')->paginate(50);
        } else {
            $warehouses = [$user->warehouse];
        }
        $data = [
            'title' => 'Add Purchase',
            'flag' => 'purchase',
            'action' => route('purchase.create'),
            'invoice_no' => TransactionService::newInvoice(),
            'partners' => $partners,
            'warehouses' => $warehouses
        ];

        return parent::render($data, 'transactions.add_purchase');
    }

    public function receive(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('purchase.view');
        }

        $transaction = TransactionService::getPurchase($id);

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
            $transaction->received = $transaction->received + $paid;
            $transaction->save();

            event(new SupplierPaymentReceived($transaction, $paid));
            return redirect()->route('purchase.view')->with('success', 'Payment processed successfully');
        }
    }

    public function returned(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $returns = TransactionService::returnedPurchases();
        } else {
            $warehouse = $user->warehouse();

            if($warehouse) {
                $returns = TransactionService::returnedPurchases($warehouse->id);
            } else {
                $returns = collect([]);
            }
        }
        
        // dd($returns);
        $data = [
            'title' => 'Returned Purchases',
            'flag' => 'purchase',
            'transactions' => $returns
        ];
        return parent::render($data, 'transactions.reversed');
    }

    public function return_purchase(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('purchase.view');
        }
        $purchase = TransactionService::getPurchase($id);
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
