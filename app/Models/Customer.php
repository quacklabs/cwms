<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SaleReturn;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = [
        'name','email','mobile_no', 'address'
    ];

    // public function

    // public function

    public function returns() {
        return $this->hasMany(SaleReturn::class, 'customer_id');
    }


}
