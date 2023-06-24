<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Contracts\Transaction;

class Purchase extends Model implements Transaction
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase';
    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'warehouse_id',
        'total_price',
        'discount_amount',
        'paid_amount',
        'note',
        'return_status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function owner() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function payable(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full;
    }

    public function due(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full - $this->received_amount;
    }
}
