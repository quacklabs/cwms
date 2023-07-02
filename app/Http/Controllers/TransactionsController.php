<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Supplier;
use App\Contracts\TransactionInterface;
use App\Enums\TransactionType;

use Faker\Factory;
use Faker\Provider\Barcode;

use App\Rules\DecimalComparison;
use App\Http\Helpers\Transaction;


class TransactionsController extends Controller {

    protected function view(Request $request) {

        $flag = $request->route('flag');
        if(!$flag) {
            return redirect()->route('dashboard');
        }
 
        if(TransactionType::isEqual($flag, TransactionType::PURCHASE)) {
            $transactions = Transaction::getPurchases(Auth::user());
        } else if(TransactionType::isEqual($flag, TransactionType::SALE)) {
            $transactions = Transaction::getSales(Auth::user());
        } else {
            return redirect()->route('dashboard');
        }
        $data = [
            'title' => ucwords($flag).'s',
            'items' => $transactions,
            'flag' => $flag
        ];

        return parent::render($data, 'transactions.view_transactions');
    }

    public function create(Request $request) {
        $flag = $request->route('flag');
        if(!$flag) {
            return redirect()->route('dashboard');
        }

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
            
            $transaction = Transaction::create($valid, $flag);
            if($transaction) {
                return redirect()->route('transaction.view', ['flag' => $flag])->with('success', 'order added successfully');
            }
        }

        switch($flag) {
            case 'purchase':
                $partners = Supplier::orderBy('created_at', 'desc')->where('status', true)->paginate(25);
                break;
            case 'sale':
                $partners = Customer::orderBy('created_at', 'desc')->where('status', true)->paginate(25);
                break;
        }

        $faker = Factory::create();
        $faker->addProvider(new Barcode($faker));
        $warehouses = Transaction::warehouse(auth()->user());
        $data = [
            'title' => 'Add '.ucwords($flag),
            'flag' => $flag,
            'invoice_no' => $faker->ean13(false),
            'partners' => $partners,
            'warehouses' => $warehouses
        ];

        return parent::render($data, 'transactions.add_transaction');
    }

    public function enter_ledger(Request $request) {
        $flag = $request->route('flag');
        $id = $request->route('id');
        if(!$flag || !$id) {
            return redirect()->route('dashboard');
            // dd($request->route());
        }

        if(TransactionType::isEqual($flag, TransactionType::PURCHASE)) {
            $transaction = Transaction::purchase($id);
        } else if(TransactionType::isEqual($flag, TransactionType::SALE)) {
            $transaction = Transaction::sale($id);
        } else {
            return redirect()->route('dashboard');
        }

        if(!$transaction) {
            return redirect()->route('dashboard');
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
            // dd($transaction);
            $transaction->save();
            return redirect()->route('transaction.view', ['flag' => $flag])->with('success', 'Payment processed successfully');
        }
    }

    public function update(Request $request) {

    }


    public function delete(Request $request) {
        
    }
}
