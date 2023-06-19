<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;
use App\Models\User;

class WarehouseSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $warehouse = Warehouse::create([
            "name" => "KIGG BENIN WAREHOUSE",
            "address" => "4,Omorose Close Off Omomena Street, Barbers Bus Stop, Oko Central, Along Airport Road, Benin City."
        ]);

        $users = User::all();
        $warehouse->staff()->attach($users);
    }
}
