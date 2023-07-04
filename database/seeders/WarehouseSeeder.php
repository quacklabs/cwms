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
        
        $warehouses = Warehouse::factory()->count(2)->create();
        $users = User::all();
        $manager_role = Role::where('name', 'manager')->first(); // Replace 'admin' with the desired role name
        $staff_role = Role::where('name', 'staff')->first();
        $managers = User::role($manager_role)->get();
        $staff = User::role($staff_role)->get();

        foreach($warehouses as $index => $warehouse) {
            $managers[$index]->warehouse_id = $warehouse->id;
            $managers[$index]->save();
            // $warehouse->manager_id = $managers[$index]->id;
            // $warehouse->staff()->attach($managers[$index]);
            // $warehouse->save();
        }

        
        // Get users by a specific role
        
        
        // dd($user);
        
        
        
    }
}
