<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SaleReturn;
use App\Models\Sale;
use App\Models\Customer;
use App\Traits\ActionTakenBy;

class SaleReturn extends Model
{
    use HasFactory, ActionTakenBy;

    protected $table = 'sale_return';

    protected $appends = [
        'url', 'due'
    ];

    protected $fillable = [
        'sale_id', 'customer_id','date','total_price',
        'discount','receivable','received'
    ];

    public function getDueAttribute() {
        return $this->due();
    }

    public function payable(): float {
        $full = $this->total_price - $this->discount;
        return $full;
    }

    public function due() {
        return floatval($this->receivable - $this->received);
    }

    public function partner() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function details() {
        return $this->hasMany(SaleReturnDetail::class, 'return_id');
    }

    public function owner() {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function getUrlAttribute() {
        return route('sale.return_payment', ['id' => $this->id]);
    }
}
