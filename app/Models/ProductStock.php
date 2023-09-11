<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Purchase;

class ProductStock extends Model
{
    use HasFactory;
    protected $table = 'product_stock';
    protected $fillable = ['purchase_id', 'warehouse_id', 'product_id', 'ownership', 'owner', 'in_transit', 'serial', 'sold', 'sold_by', 'sold_from', 'sale_id'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function trail() {
        return $this->belongsTo(Purchase::class);
    }
}
