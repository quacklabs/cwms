<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Warehouse;
use App\Traits\ActionTakenBy;
use App\Models\AdjustmentDetail;

class Adjustment extends Model
{
    use HasFactory, SoftDeletes, ActionTakenBy;

    protected $table = "adjustment";

    protected $fillable = [
        'warehouse_id',
        'adjust_date',
        'tracking_no',
        'note'
    ];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function details() {
        return $this->hasMany(AdjustmentDetail::class, 'adjustment_id');
    }
}
