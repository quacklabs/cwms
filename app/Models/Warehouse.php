<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Policies\WarehousePolicy;
use Illuminate\Database\Eloquent\SoftDeletes;
use APp\Models\Purchase;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'warehouse';
    protected $fillable = ["name","address","status", 'manager_id'];
    protected $policy = WarehousePolicy::class;

    public function staff() {
        return $this->belongsToMany(User::class);
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
}
