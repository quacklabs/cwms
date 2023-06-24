<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Warehouse;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase';
    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'warehouse_id',
        'total_price',
        'discount_amount',
        'payable_amount',
        'paid_amount',
        'due_amount',
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
}
