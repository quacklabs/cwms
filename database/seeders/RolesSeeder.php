<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;

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
        $admin_role = Role::create(['name' => 'admin']);
        $manager_role = Role::create(['name' => 'manager']);
        $staff_role = Role::create(['name' => 'staff']);
        $grantAdmin = Permission::create(['name' => 'grant-manager-permissions']);
        $admin_role->givePermissionTo($grantAdmin);

        foreach($list as $key => $permissions) {
            $group = PermissionGroup::create(['name' => $key]);
            
            foreach($permissions as $permission) {
                $permission = Permission::create([
                    'name' => $permission,
                    'permission_group_id' => $group->id,
                ]);
                $admin_role->givePermissionTo($permission);
            }
        }
        $userGroup = 'user';
        $group = PermissionGroup::where('name', $userGroup)->first();
        $managerNotPermitted = Permission::whereNotIn('name', [
            'create-manager', 
            'delete-brand',
            'delete-warehouse',
            'suspend-warehouse',
            'delete-supplier',
            'delete-product',
            'delete-store',
            'delete-category',
            'modify-store',
            'delete-unit',
            'transfer-user',
            'grant-manager-permission',
            'delete-customer',
            'reassign-manager',
            'suspend-category',
        ])->get();
    
        $manager_perms = array_map(function($permission) {
            return $permission['name'];
        }, $managerNotPermitted->toArray());

        $staffNotAllowed = 
        $staff_perms = Permission::whereNotIn('name', [
            'create-manager', 
            'delete-brand',
            'delete-warehouse',
            'delete-supplier',
            'delete-product',
            'delete-store',
            'modify-store',
            'delete-unit',
            'transfer-user',
            'grant-manager-permission',
            'tokenize-product-transfer',
            'create_store',
            'create-user',
            'create-category',
            'create-brand',
            'create-warehouse',
            'create-store',
            'suspend-user',
            'delete-user',
            'delete-customer',
            'suspend-customer',
            'approve-user-transfer',
            'grant-user-permission',
            'modify-warehouse',
            'grant-product-permission',
            'reassign-manager',
            'suspend-category',
            'modify-category',
            'create-sale-return',
            'approve-purchase',
            'approve-sale',
            'adjust-stock'
        ])->get();
        
        // dd($managerProductPerms);
        // $manager_perms = array_merge($managerUserperms, $managerProductPerms, $managerWarehousePerms, $managerStorePerms);
        $manager_role->syncPermissions($manager_perms);
        $staff_role->syncPermissions($staff_perms);
        // $manager_role->syncPermissions();
        // $manager_role->syncPermissions();
        // $manager_role->syncPermissions();
    }

    private function defaultPermissions(): array {
        return [
            'user' => [
                'create-user',
                'create-manager',
                'grant-user-permission',
                'suspend-user',
                'transfer-user',
                'approve-user-transfer',
                'create-customer',
                'delete-customer',
                'modify-customer',
                'create-supplier',
                'delete-supplier',
                'modify-supplier'
            ],
            'product' => [
                'create-category',
                'create-brand',
                'create-unit',
                'delete-unit',
                'delete-category',
                'delete-brand',
                'delete-product',
                'modify-brand',
                'modify-category',
                'grant-product-permission',
                'create-product-category',
                'create-product',
                'modify-product',
                'transfer-product',
                'approve-product-transfer',
                'adjust-stock'
            ],
            'warehouse' => [
                'create-warehouse',
                'delete-warehouse',
                'modify-warehouse',
                'suspend-warehouse',
                'reassign-manager'
            ],
            'store' => [
                'create-store',
                'delete-store',
                'modify-store',
            ],
            'transactions' => [
                'view-purchase',
                'create-purchase',
                'view-purchase-return',
                'create-purchase-return',
                'approve-purchase-return',
                'delete-purchase',
                'create-sale',
                'approve-purchase',
                'view-sale',
                'view-sale-return',
                'delete-sale',
                'approve-sale',
                'create-sale-return',
                'approve-sale-return'
            ]
        ];
    }
}
