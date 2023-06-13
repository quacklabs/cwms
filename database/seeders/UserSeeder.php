<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $admin_data = [
            "name" => "Super Admin",
            "email" => "info@celdongroup.com",
            "password" => "12345678",
            "username" => "admin",
            "mobile" => "+1223445566"
        ];
        $admin = User::create($admin_data);
        $admin_role = Role::findByName('admin');
        $admin->assignRole($admin_role);
        $admin->save();


        $manager_data = [
            "name" => "Manager",
            "email" => "manager@celdongroup.com",
            "password" => "12345678",
            "username" => "manager1",
            "mobile" => "+1223445566"
        ];

        $manager = User::create($manager_data);
        $manager_role = Role::findByName('manager');
        $manager->assignRole($manager_role);


        $staff_data = [
            "name" => "Staff",
            "email" => "staff@celdongroup.com",
            "password" => "12345678",
            "username" => "staff1",
            "mobile" => "+1223445566"
        ];
        $staff = User::create($staff_data);
        $role = Role::findByName('staff');
        $staff->assignRole($role);
    }
}
