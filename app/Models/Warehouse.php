<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Policies\WarehousePolicy;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'warehouse';
    protected $fillable = ["name","address","status"];
    protected $policy = WarehousePolicy::class;

    public function staff() {
        return $this->belongsToMany(User::class);
    }
}
