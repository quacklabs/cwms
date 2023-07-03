<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Adjustment;
use App\Traits\ActionTakenBy;

class AdjustmentDetail extends Model
{
    use HasFactory, SoftDeletes, ActionTakenBy;

    protected $table = "adjustment_detail";

    protected $fillable = [
        'adjustment_id','product_id','quantity','adjust_type'
    ];

    public function adjustment() {
        return $this->belongsTo(Adjustment::class, 'adjustment_id');
    }
    
}
