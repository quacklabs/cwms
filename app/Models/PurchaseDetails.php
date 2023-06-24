<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Purchase;
use App\Models\Product;

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
        return $this->belongsTo(Purchase::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }

}
