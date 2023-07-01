<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseReturnDetail;

class PurchaseReturn extends Model
{
    use HasFactory;

    protected $table = 'purchase_return';

    protected $fillable = [
        'purchase_id', 'supplier_id','date','total_price',
        'discount','receivable','received'
    ];


    public function details() {
        return $this->hasMany(PurchaseReturnDetail::class, 'purchase_id');
    }

}
