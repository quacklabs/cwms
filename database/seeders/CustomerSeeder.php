<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Supplier;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Customer::create([
            'name' => 'John Doe',
            'email' => 'name@example.com',
            'mobile_no' => '28664678585',
            'status' => true,
            'address' => '3 Maple Road, Lekki'
        ]);

        Supplier::create([
            'name' => 'John Doe',
            'email' => 'name@example.com',
            'mobile_no' => '28664678585',
            'status' => true,
            'address' => '3 Maple Road, Lekki'
        ]);
    }
}
