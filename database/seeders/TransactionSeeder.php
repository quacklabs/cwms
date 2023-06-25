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

        // $purchases = Purchase::factory()->count(5)->create();
        // foreach($purchases as $purchase) {
        //     ProductStock::create([
        //         'warehouse_id' => $purchase->warehouse_id,
        //         'product_id' => $order['product_id'],
        //         'quantity' => $order['quantity']
        //     ]);
        // }
        // Sale::factory()->count(5)->create();
    }
}
