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
    }
}
