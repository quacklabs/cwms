<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseReturnDetail;
use App\Models\Purchase;

class PurchaseReturn extends Model
{
    use HasFactory;

    protected $table = 'purchase_return';

    protected $fillable = [
        'purchase_id', 'supplier_id','date','total_price',
        'discount','receivable','received'
    ];

    public function due() {
        return floatval($this->receivable - $this->received);
    }

    public function details() {
        return $this->hasMany(PurchaseReturnDetail::class, 'purchase_id');
    }

    public function purchase() {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

}
