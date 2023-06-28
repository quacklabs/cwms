<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $table = 'sale_item';

    protected $fillable = [
        'product_id', 'sale_id', 'sale_warehouse',
        'serial_no'
    ];
}
