<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\PurchaseDetails;
use App\Contracts\TransactionInterface;

class Purchase extends Model implements TransactionInterface
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase';
    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'warehouse_id',
        'total_price',
        'discount_amount',
        'paid_amount',
        'note',
        'return_status',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $appends = [
        'due', 'payable', 'url'
    ];

    public function details() {
        return $this->hasMany(PurchaseDetails::class, 'purchase_id');
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
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
        return $full - $this->paid_amount;
    }

    public static function purchase(int $id): Purchase {
        return self::find($id);
    }

    public static function sale(int $id): Sale {
        return  new Sale();
        // return self::find($id);
    }

    public function getUrlAttribute() {
        return route('transaction.enter_ledger', ['flag' => 'purchase', 'id' => $this->id]);
    }
}
