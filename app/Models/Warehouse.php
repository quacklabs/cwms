<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
// use App\Policies\WarehousePolicy;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Purchase;
use App\Models\Transfer;
use App\Traits\ActionTakenBy;
use App\Models\UserWarehouse;
use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes, ActionTakenBy;

    protected $table = 'warehouse';
    protected $fillable = ["name","address","status", 'manager_id'];
    // protected $policy = WarehousePolicy::class;

    public function staff() {
        return $this->hasMany(User::class, 'warehouse_id');
    }

    public function manager() {
        
        if(isset($this->manager_id)) {
            $id = $this->manager_id;
            $user = User::where('id', $id)->get()->first();
            return $user;
        } else {
            return null;
        }
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

    public function products() {
        $id = $this->id;
        $stock = ProductStock::where('warehouse_id', $id)
        ->select('product_id', DB::raw('COUNT(*) as group_count'))
        ->groupBy('product_id')
        ->get()->count();
        return $stock;
    }
}
