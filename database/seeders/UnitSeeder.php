<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $units = [
            ['name' => 'kg'],
            ['name' => 'crate'],
            ['name' => 'carton']
        ];
        Unit::insert($units);
    }
}
