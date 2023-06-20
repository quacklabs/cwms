<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;
use App\Models\User;
use Spatie\Permission\Models\Role;

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
        // Get users by a specific role
        $role = Role::where('name', 'manager')->first(); // Replace 'admin' with the desired role name
        $user = User::role($role)->first();
        // dd($user);
        $warehouse->manager_id = $user->id;
        $warehouse->save();
        $warehouse->staff()->attach($users);
    }
}
