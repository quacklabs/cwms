<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SaleReturn;
use App\Traits\ActionTakenBy;

class Customer extends Model
{
    use HasFactory, ActionTakenBy;
    protected $table = 'customer';
    protected $fillable = [
        'name','email','mobile_no', 'address'
    ];

    public function returns() {
        return $this->hasMany(SaleReturn::class, 'customer_id');
    }


}
