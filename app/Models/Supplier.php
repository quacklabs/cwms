<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Traits\ActionTakenBy;
use App\Models\Action;

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

    public function actions(): MorphMany {
        return $this->morphMany(Action::class, 'model_type');
    }
}
