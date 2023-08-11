<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
use App\Models\Product;

class ProductStock extends Model
{
    use HasFactory;
    protected $table = 'product_stock';
    protected $fillable = ['warehouse_id', 'product_id', 'ownership', 'owner', 'serial', 'sold', 'sold_by', 'sold_from'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}
