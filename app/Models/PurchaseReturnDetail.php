<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PurchaseReturn;

class PurchaseReturnDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_return_detail';

    protected $fillable = [
        'return_id','product_id','serial', 'price'
    ];


    public function return() {
        return $this->belongsTo(PurchaseReturn::class, 'return_id');
    }
}
