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


class TransactionsController extends Controller implements TransactionInterface {

    protected function view(Request $request) {

        $flag = $request->route('flag');
        if(!$flag) {
            return redirect()->route('dashboard');
        }

        if(TransactionType::isEqual($flag, TransactionType::PURCHASE)) {
            $transactions = Purchase::orderBy('created_at', 'desc')->paginate(25);
        } else if(TransactionType::isEqual($flag, TransactionType::SALE)) {
            $transactions = Sale::orderBy('created_at', 'desc')->paginate(25);
        } else {
            return redirect()->route('dashboard');
        }
        // $purchases = Purchase::orderBy('created_at', 'desc')->paginate(25);
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
        $warehouses = Warehouse::orderBy('created_at', 'desc')->where('status', true)->paginate(25);
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
            $transaction = $this->purchase($id);
        } else if(TransactionType::isEqual($flag, TransactionType::SALE)) {
            $transaction = $this->sale($id);
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
            $transaction->received_amount = $transaction->received_amount + $paid;
            $transaction->save();
            return redirect()->route('transaction.view', ['flag' => $flag])->with('success', 'Payment processed successfully');
        }
        $title = TransactionType::isEqual($flag, TransactionType::SALE) ? "Receive Payment" : "Give Payment";
        $action = TransactionType::isEqual($flag, TransactionType::SALE) ? 'received' : 'given';
        $data = [
            'title' => $title,
            'transaction' => $transaction,
            'action' => $action,
            'flag' => $flag
        ];

        return parent::render($data, 'transactions.enter_ledger');
    }

    public function update(Request $request) {

    }


    public function delete(Request $request) {
        
    }

    public function purchase(int $id): Purchase {
        return Purchase::findOrFail($id);
    }

    public function sale(int $id): Sale {

    }
}
