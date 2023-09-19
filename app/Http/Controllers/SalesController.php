<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\TransactionService;
use App\Models\Supplier;
use App\Rules\DecimalComparison;
use App\Rules\Decimal;
use App\Models\Warehouse;
use App\Models\Store;

use App\Events\CustomerPaymentReceived;

class SalesController extends Controller
{
    //

    protected $flag = 'sale';

    protected function view(Request $request) {
        $user = Auth::user();
        $range = request('dateRange');
        $invoice = request('invoice');
        if(isset($range)) {
            $transactions = TransactionService::getSalesByRange($user, $range);
        } else if(isset($invoice)) {
            $transactions = TransactionService::getSalesByInvoice($user, $invoice);
        } else {
            $transactions = TransactionService::getSales($user);
        }
        
        $data = [
            'title' => 'View Sales',
            'items' => $transactions,
            'flag' => $this->flag
        ];
        return parent::render($data, 'transactions.view_transactions');
    }

    public function create(Request $request) {
        $user = Auth::user();
        $flag = $request->route('flag');
        if($request->method() == 'POST') {
            $valid = Validator::make($request->all(), [
                'partner_id' => ['required', 'numeric'],
                'location_id' => ['required', 'numeric'],
                'date' => ['required', 'date'],
                'order' => ['required'],
                'discount_amount' => ['numeric', 'nullable'],
                'total_price' => ['required', 'decimal'],
                'invoice_no' => ['required'],
                'notes' => ['nullable', 'string']
            ]);

            if($valid->fails()) {
                return redirect()->back()->withErrors($valid);
            }

            $form_data = $valid->validated();
            if($user->hasRole('admin')) {
                // TransactionService::create($valid, );
            } else if($user->hasRole('manager')) {
                
            } else if($user->hasRole('storeManager')) {
                
            }
           
           return redirect()->route('sale.view')->with('success', 'order added successfully');
        }
        $partners = Supplier::orderBy('created_at', 'desc')->where('status', true)->paginate(25);
        $data = [
            'title' => 'Sale',
            'invoice_no' => TransactionService::newInvoice(),
            'flag' => $flag,
            'partners' => $partners
        ];

        if($user->hasRole('admin')) {
            $page = 'transactions.admin_sale';
            $data['warehouses'] = ($flag == 'warehouse') ? Warehouse::take(50)->get() : Store::take(50)->get();
        } else if($user->hasRole('manager')) {
            $page = 'transactions.warehouse_sale';
        } else if($user->hasRole('storeManager')) {
            $page = 'transactions.store_sale';
        }
        return parent::render($data, $page);
    }

    public function receive(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('sale.view');
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
            $transaction->received = $transaction->received + $paid;
            $transaction->save();

            event(new CustomerPaymentReceived($transaction, $paid));
            
            return redirect()->route('sale.view')->with('success', 'Payment processed successfully');
        }
    }

    public function returned(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $returns = TransactionService::returnedSales();
        } else {
            $warehouse = $user->warehouse();
            if($warehouse) {
                $returns = TransactionService::returnedSalesByWarehouse($warehouse->id);
            } else {
                $collection = new Collection();
                // $currentPageItems = $collection->slice($offset, $perPage)->all();
                $returns = new LengthAwarePaginator($collection, count($collection), 0, 1);
                // Set the path for the paginator
                $returns->setPath(Request::url());
            
                // return $paginator;
            }
        }
        
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


    public function return_payment(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('sale.returned');
        }

        $transaction = TransactionService::sale_return($id);

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
