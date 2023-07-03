<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseReturnDetail;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Traits\ActionTakenBy;
use App\Models\Action;

class PurchaseReturn extends Model
{
    use HasFactory, ActionTakenBy;

    protected $table = 'purchase_return';

    protected $fillable = [
        'purchase_id', 'supplier_id','date','total_price',
        'discount','receivable','received'
    ];

    protected $appends = [
        'url', 'due'
    ];

    public function getDueAttribute() {
        return $this->due();
    }

    public function due() {
        return floatval($this->receivable - $this->received);
    }

    public function partner() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function details() {
        return $this->hasMany(PurchaseReturnDetail::class, 'return_id');
    }

    public function owner() {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function getUrlAttribute() {
        return route('purchase.receive', ['id' => $this->id]);
    }

    public function actions(): MorphMany {
        return $this->morphMany(Action::class, 'model_type');
    }

}
