<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class SaleDetails extends Model
{
    use HasFactory;
    protected $table = "sales_details";

    public function sale() {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
