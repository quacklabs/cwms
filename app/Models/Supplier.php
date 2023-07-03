<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Traits\ActionTakenBy;

class Supplier extends Model
{
    use HasFactory, ActionTakenBy;
    protected $table = 'supplier';
    protected $fillable = [
        'name','email','mobile_no', 'address'
    ];

    public function purchases() {
        return $this->hasMany(Purchase::class);
    }


    public function returns() {
        return $this->hasMany(PurchaseReturn::class, 'supplier_id');
    }
}
