<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TransferDetail;

class Transfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transfer';
    protected $fillable = [
        'tracking_no', 'from_warehouse', 'to_warehouse','transfer_date','note','balanced'
    ];

    protected $casts = [
        'transfer_date' => 'datetime:Y-m-d'
    ];

    public function details() {
        return $this->hasMany(TransferDetail::class, 'transfer_id');
    }

    public function getTotalProductsAttribute() {
        return count($this->details);
    }

    public function source_warehouse() {
        return $this->belongsTo(Warehouse::class, 'from_warehouse');
    }

    public function destination_warehouse() {
        return $this->belongsTo(Warehouse::class, 'to_warehouse');
    }
}
