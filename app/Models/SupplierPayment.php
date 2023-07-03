<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Supplier;
use App\Models\Purchase;
use Carbon\Carbon;

class SupplierPayment extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'supplier_payments';

    protected $casts= [
        'date' => 'datetime:d-m-Y'
    ];

    protected $fillable = [
        'purchase_id', 'supplier_id', 'purchase_return_id',
        'amount', 'trx', 'remarks'
    ];

    public function owner() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function getDateAttribute() {
        return Carbon::parse($this->created_at)->toDateString();
    }

    public function transaction() {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
}
