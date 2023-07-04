<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Policies\WarehousePolicy;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Purchase;
use App\Models\Transfer;
use App\Traits\ActionTakenBy;
use App\Models\UserWarehouse;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes, ActionTakenBy;

    protected $table = 'warehouse';
    protected $fillable = ["name","address","status", 'manager_id'];
    protected $policy = WarehousePolicy::class;

    public function staff() {
        return $this->hasMany(User::class, 'warehouse_id');
    }

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function getActiveCategoriesAttribute() {
        return $this->categories()->where('status', true)->get();
    }

    public function stores() {
        return $this->hasMany(Store::class);
    }

    public function purchases() {
        return $this->hasMany(Purchase::class, 'warehouse_id');
    }

    public function inward_transfer() {
        return $this->hasMany(Transfer::class, 'to_warehouse');
    }

    public function outward_transfer() {
        return $this->hasMany(Transfer::class, 'from_warehouse');
    }
}
