<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\AnalyticsModels\TransactionDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sale;

class SaleDetails extends TransactionDetail
{
    use HasFactory, SoftDeletes;
    protected $table = "sales_details";
    protected $fillable = [
        'sale_id', 'product_id','quantity', 'price', 'total'
    ];

    public function transaction(): BelongsTo {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
