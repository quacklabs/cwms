<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Store::create([
            'name' => 'Test Store',
            'warehouse_id' => 1,
            'address' => 'Test store address',
        ]);
    }
}
