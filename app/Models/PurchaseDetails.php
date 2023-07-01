<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\ProductStock;

class PurchaseDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase_details';

    protected $fillable = [ 
        'purchase_id', 'product_id','quantity','price','total'
    ];

    protected $casts = [
        'purchase_date' => 'date',
    ];

    public function purchase() {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getStockAttribute() {
        $stock = ProductStock::where('warehouse_id', $this->purchase->warehouse_id)
        ->where('product_id', $this->product_id)->where('sold', false)->get();
        return count($stock);
    }

}
