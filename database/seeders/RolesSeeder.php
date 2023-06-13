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
        $admin_role->syncPermissions(Permission::all());
        
        $manager_role = Role::create(['name' => 'manager']);
        $manager_role->syncPermissions([
            'create-user', 'create-store', 'grant-product-permission'
        ]);
        
        Role::create(['name' => 'staff']);
    }

    private function defaultPermissions(): array {
        return [
            'create-user',
            'grant-user-permission',
            'grant-product-permission',
            'create-warehouse',
            'create-store',
            'create-manager'
        ];
    }
}
