<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;
use Spatie\Permission\Traits\HasPermissions;

class Permissions extends Permission
{
    use HasFactory, HasPermissions; 
    protected $table = 'permissions';

    public function permissionGroup(){
        return $this->belongsTo(PermissionGroup::class, 'permission_group_id');
    }
}
