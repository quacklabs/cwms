<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use App\Models\AnalyticsModels\Transaction;

use App\Models\AnalyticsModels\TransactionDetail;

class PurchaseDetails extends TransactionDetail
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase_details';

    protected $fillable = [ 
        'purchase_id', 'product_id','quantity','price','total'
    ];

    protected $casts = [
        'purchase_date' => 'date',
    ];

    // public function purchase() {
    //     return $this->belongsTo(Purchase::class, 'purchase_id');
    // }
    
    public function transaction(): BelongsTo {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getStockAttribute() {
        $stock = ProductStock::where('warehouse_id', $this->purchase->warehouse_id)
        ->where('product_id', $this->product_id)->where('sold', false)->get();
        return count($stock);
    }

}
