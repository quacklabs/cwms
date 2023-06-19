<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\PermissionGroup;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller {
    //

    public function role_permissions(Request $request) {
        
        $staff_role = Role::findByName('staff');
        $user = Auth::user();
        $manager_role = Role::findByName('manager');

        $data = [
            "title" => "Role Permissions",
            "manager_role" => $manager_role,
            "staff_role" => $staff_role,
            "user" => $user
        ];

        if($request->method() == "POST") {
            $role = $request->route('role');
            if($role) {
                $selectedCheckboxes = [];

                foreach ($request->all() as $name => $value) {
                    if ($request->has($name)) {
                        $selectedCheckboxes[] = Permissions::where('name', $name)->first();
                    }
                } 
                // dd($selectedCheckboxes);
                $selectedRole = Role::findByName($role);
                $selectedRole->permissions()->detach();
                $selectedRole->syncPermissions($selectedCheckboxes);
                return redirect()->route('access.byRole')->with('success', 'Permissions Updated');
            }
        }

        if($user->hasRole('admin')) {
            $data['user_permissions'] = PermissionGroup::where('name', 'user')->first()->permissions;
            $data["store_permissions"] = PermissionGroup::where('name', 'store')->first()->permissions;
            $data["warehouse_permissions"] = PermissionGroup::where('name', 'warehouse')->first()->permissions;
            $data["product_permissions"] = PermissionGroup::where('name', 'product')->first()->permissions;
            // $data['manager_role'] = $manager_role;
            // $data['staff_role'] = $staff_role;
        } else {
            $params = array_map(function($perm) {
                return $perm['name'];
            }, $staff_role->permissions->toArray());
            $user_perms = PermissionGroup::where('name', 'user')->first()->permissions()->whereIn('name', $params)->get();
            $warehouse_perms = Permissions::whereIn('name', $params)->get();
            $product_perms = Permissions::whereIn('name', $params)->get();
            $store_perms = Permissions::whereIn('name', $params)->get();
            $data['warehouse_permissions'] = $warehouse_perms;
            $data["product_permissions"] = $product_perms;
            $data["store_permissions"] = $store_perms;
            $data['user_permissions'] = $user_perms;
        }

        return parent::render($data, 'access/role_permissions');
    }

    public function user_permissions(Request $request) {
        $staff = $request->route('id');
        if(!$staff) {
            return redirect()->route('staff.staff');
        }
        
        $user = User::find($staff);
        if(!$user) {
            return redirect()->route('staff.staff');
        }
        $staff_role = Role::findByName('manager');
        $data = [
            "title" => "User Permissions",
            "staff_role" => $staff_role,
            "staff" => $user
        ];

        if($request->method() == "POST") {
            // $role = $request->route('role');
            foreach ($user->permissions as $permission) {
                $user->revokePermissionTo($permission);
            }

            foreach ($request->all() as $name => $value) {
                if ($request->has($name)) {
                    $permission = Permissions::where('name', $name)->first();
                    $user->givePermissionTo($permission);
                }
            }

            return redirect()->route('staff.staff')->with('success', 'Permissions Updated');
        }

        if($user->hasRole('admin')) {
            $data['user_permissions'] = PermissionGroup::where('name', 'user')->first()->permissions;
            $data["store_permissions"] = PermissionGroup::where('name', 'store')->first()->permissions;
            $data["warehouse_permissions"] = PermissionGroup::where('name', 'warehouse')->first()->permissions;
            $data["product_permissions"] = PermissionGroup::where('name', 'product')->first()->permissions;
        } else {
            $params = array_map(function($perm) {
                return $perm['name'];
            }, $staff_role->permissions->toArray());
            $user_perms = PermissionGroup::where('name', 'user')->first()->permissions()->whereIn('name', $params)->get();
            $warehouse_perms = PermissionGroup::where('name', 'warehouse')->first()->permissions()->whereIn('name', $params)->get();
            $product_perms = PermissionGroup::where('name', 'product')->first()->permissions()->whereIn('name', $params)->get();
            $store_perms = PermissionGroup::where('name', 'store')->first()->permissions()->whereIn('name', $params)->get();
            $data['warehouse_permissions'] = $warehouse_perms;
            $data["product_permissions"] = $product_perms;
            $data["store_permissions"] = $store_perms;
            $data['user_permissions'] = $user_perms;
        }
        return parent::render($data, 'access/user_permissions');
    }
}
