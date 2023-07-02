<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;
use App\Models\Supplier;
use App\Rules\DecimalComparison;
use App\Rules\Decimal;

class SalesController extends Controller
{
    //

    protected $flag = 'sale';

    protected function view(Request $request) {
        $transactions = TransactionService::getSales(Auth::user());
        $data = [
            'title' => 'View Sales',
            'items' => $transactions,
            'flag' => $this->flag
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
                'invoice_no' => ['required'],
                'notes' => ['nullable', 'string']
            ]);
            
           TransactionService::create($valid, $this->flag);
           return redirect()->route('sale.view')->with('success', 'order added successfully');
        }
        $partners = Supplier::orderBy('created_at', 'desc')->where('status', true)->paginate(25);
        $data = [
            'title' => 'Sale',
            'flag' => $this->flag,
            'action' => route('sale.create'),
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

        $transaction = TransactionService::sale($id);

        if(!$transaction) {
            return redirect()->route('sale.view')->with('error', 'Unable to adjust payment. Invalid transaction');
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
            return redirect()->route('sale.view')->with('success', 'Payment processed successfully');
        }
    }

    public function returned(Request $request) {
        $user = Auth::user();
        $returns = TransactionService::returnedSales($user->warehouse->first()->id);
        // dd($returns);
        $data = [
            'title' => 'Returned Sales',
            'flag' => $this->flag,
            'transactions' => $returns
        ];
        return parent::render($data, 'transactions.reversed');
    }

    public function return_sale(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('sale.view');
        }
        $purchase = TransactionService::sale($id);
        if(!$purchase) {
            return redirect()->route('sale.view')->with('error', 'Invalid Transaction ID');
        }

        $data = [
            'title' => 'Return Sale',
            'transaction' => $purchase,
            'flag' => $this->flag,
            'action' => route('sale.return', ['id' => $id])
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

            TransactionService::returnSale($valid, $purchase);
            return redirect()->route('sale.returned')->with('success', 'Sale returned successfully');
        }

        return parent::render($data, 'transactions.reverse');
    }

    public function payment(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('sale.returned');
        }

        $transaction = TransactionService::sale($id);

        if(!$transaction) {
            return redirect()->route('sale.returned')->with('error', 'Unable to adjust payment. Invalid transaction');
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
            return redirect()->route('sale.returned')->with('success', 'Payment processed successfully');
        }

        return redirect()->route('sale.returned');
    }
}
