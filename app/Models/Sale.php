<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Warehouse;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'warehouse_id',
        'discount_amount',
        'payable_amount',
        'paid_amount',
        'due_amount',
        'note',
        'return_status'
    ];
}
