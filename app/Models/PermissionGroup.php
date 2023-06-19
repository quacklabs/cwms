<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permissions;
use Spatie\Permission\Traits\HasPermissions;

class PermissionGroup extends Model
{
    use HasFactory, HasPermissions;
    protected $table = 'permission_groups';

    public function relate() {
        dd($this->getRelations());
    }

    public function permissions() {
        return $this->hasMany(Permissions::class, 'permission_group_id');
    }
}
