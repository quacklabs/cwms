<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Purchase;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Purchase::create([
            'supplier_id' => 1,
            'invoice_no' => '223433',
            'warehouse_id' => 1,
            'discount_amount' => 0.00,
            'payable_amount' => 50.00,
            'paid_amount' => 50.00,
            'due_amount' => 50.00,
            'total_price' => 50.00,
            'note' => '',
            'return_status' => false
        ]);

        Purchase::create([
            'supplier_id' => 1,
            'invoice_no' => '225433',
            'warehouse_id' => 1,
            'discount_amount' => 0.00,
            'payable_amount' => 50.00,
            'paid_amount' => 30.00,
            'due_amount' => 50.00,
            'total_price' => 50.00,
            'note' => '',
            'return_status' => false
        ]);
    }
}
