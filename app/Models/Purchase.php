<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\PurchaseDetails;
use App\Contracts\TransactionInterface;
use App\Models\PurchaseReturn;
use App\Models\SupplierPayment;
use App\Traits\ActionTakenBy;
use App\Models\Action;
use App\Models\AnalyticsModels\Transaction;
use Carbon\Carbon;

class Purchase extends Transaction {
    use HasFactory, SoftDeletes, ActionTakenBy;

    protected $table = 'purchase';
    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'warehouse_id',
        'total_price',
        'discount_amount',
        'received',
        'note',
        'return_status',
        'date',
        'status'
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $appends = [
        'due', 'payable', 'url', 'returns', 'updateUrl'
    ];

    public function getReturnsAttribute() {
        return $this->returns();
    }

    public function details(): HasMany {
        return $this->hasMany(PurchaseDetails::class, 'purchase_id');
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function owner() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function getPayableAttribute() {
        return $this->payable();
    }

    public function payable(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full;
    }

    public function getDueAttribute() {
        return $this->due();
    }

    public function due(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full - $this->received;
    }

    public function getUpdateUrlAttribute() {
        return route('purchase.update', ['id' => $this->id]);
    }
    
    public function getUrlAttribute() {
        return route('purchase.receive', ['id' => $this->id]);
    }

    public function returns() {
        return $this->hasMany(PurchaseReturn::class, 'purchase_id');
    }

    public function supplierPayments() {
        return $this->hasMany(SupplierPayment::class, 'purchase_id');
    }

    public function actions(): MorphMany {
        return $this->morphMany(Action::class);
    }

    public function origin(): Model {
        return null;
    }

    public function getFormattedDateAttribute() {
        $date = Carbon::parse($this->date);
        return $date->format("F j, Y");
    }
}
