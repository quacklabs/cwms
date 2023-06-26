<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transfer;
use App\Models\Product;
use App\Models\Warehouse;

class TransferDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transfer_details';
    protected $fillable = [
        'transfer_id', 'product_id', 'quantity'
    ];

    public function transfer() {
        return $this->belongsTo(Transfer::class, 'transfer_id');
    }
}

