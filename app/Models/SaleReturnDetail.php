<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SaleReturn;

class SaleReturnDetail extends Model
{
    use HasFactory;

    protected $table = 'sale_return_detail';

    protected $fillable = [
        'return_id','product_id','serial', 'price'
    ];


    public function return() {
        return $this->belongsTo(SaleReturn::class, 'return_id');
    }
}
