<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PurchaseReturn;
use App\Models\Product;

class PurchaseReturnDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_return_detail';

    protected $fillable = [
        'return_id','product_id','serial', 'price'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function return() {
        return $this->belongsTo(PurchaseReturn::class, 'return_id');
    }
}
