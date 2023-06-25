<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Model\SaleDetails;

use App\Contracts\TransactionInterface;

class Sale extends Model implements TransactionInterface
{
    use HasFactory, SoftDeletes;

    protected $table = "sale";

    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'warehouse_id',
        'total_amount',
        'discount_amount',
        'received_amount',
        'note',
        'return_status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function owner() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function details() {
        return $this->hasMany(SaleDetails::class, 'sale_id');
    }

    public static function purchase(int $id) : Purchase {
        return new Purchase;
    }

    public static function sale(int $id) : Sale {
        return self::find($id);
    }


    public function payable(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full;
    }

    public function due(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full - $this->paid_amount;
    }
}
