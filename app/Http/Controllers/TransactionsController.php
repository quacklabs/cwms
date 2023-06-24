<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Supplier;
use App\Contracts\TransactionInterface;
use App\Enums\TransactionType;

use Faker\Factory;
use Faker\Provider\Barcode;


class TransactionsController extends Controller implements TransactionInterface {

    protected function view(Request $request) {

        $flag = $request->route('flag');
        if(!$flag) {
            return redirect()->route('dashboard');
        }

        if(TransactionType::isEqual($flag, TransactionType::PURCHASE)) {
            $transactions = Purchase::orderBy('created_at', 'desc')->paginate(25);
        } else if(PartnerType::isEqual($flag, PartnerType::SALE)) {
            $transactions = Sale::orderBy('created_at', 'desc')->paginate(25);
        } else {
            return redirect()->route('dashboard');
        }
        // $purchases = Purchase::orderBy('created_at', 'desc')->paginate(25);
        $data = [
            'title' => 'Purchases',
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

    public function update(Request $request) {

    }


    public function delete(Request $request) {
        
    }

    public function purchase(int $id): Purchase {

    }

    public function sale(int $id): Sale {

    }
}
