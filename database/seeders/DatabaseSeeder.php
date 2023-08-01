<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\RolesSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\StoreSeeder;
use Database\Seeders\PartnerSeeder;
use Database\Seeders\TransactionSeeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(PartnerSeeder::class);
        // $this->call(TransactionSeeder::class);
        $credentials = [
            "username" => "admin",
            "password" => "12345678"
        ];
        Auth::attempt($credentials);

    }
}
