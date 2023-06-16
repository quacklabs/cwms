<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $list = $this->defaultPermissions();
        
        foreach($list as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo($list);
        
        $manager_role = Role::create(['name' => 'manager']);
        $manager_role->givePermissionTo(['create-user', 'grant-product-permission']);
        
        $staff_role = Role::create(['name' => 'staff']);

    }

    private function defaultPermissions(): array {
        return [
            'create-user',
            'grant-user-permission',
            'grant-product-permission',
            'create-warehouse',
            'create-store',
            'create-manager',
            'suspend_user'
        ];
    }
}
