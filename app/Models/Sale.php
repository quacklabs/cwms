<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\DB;

use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\SaleDetails;
use App\Models\CustomerPayment;
use App\Traits\ActionTakenBy;

use App\Contracts\TransactionInterface;
use App\Models\AnalyticsModels\Transaction;

class Sale extends Transaction
{
    use HasFactory, SoftDeletes, ActionTakenBy;

    protected $table = "sale";

    protected $fillable = [
        'customer_id',
        'invoice_no',
        'warehouse_id',
        'total_price',
        'discount_amount',
        'received',
        'date',
        'note',
        'return_status'
    ];

    protected $appends = [
        'due', 'payable','url', 'returns'
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

    // public static function purchase(int $id) : Purchase {
    //     return new Purchase;
    // }

    // public static function sale(int $id) : Sale {
    //     return self::find($id);
    // }


    public function payable(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full;
    }

    public function getPayableAttribute() {
        return $this->payable();
    }


    public function getDueAttribute() {
        return $this->due();
    }

    public function due(): float {
        $full = $this->total_price - $this->discount_amount;
        return $full - $this->received;
    }

    public function getUrlAttribute() {
        return route('sale.receive', ['id' => $this->id]);
    }

    public function getReturnsAttribute() {
        return $this->returns();
    }

    public function returns() {
        return $this->hasMany(SaleReturn::class, 'sale_id');
    }

    public function customerPayments() {
        return $this->hasMany(CustomerPayment::class, 'purchase_id');
    }

    // public function scopePending($query) {
    //     $raw = function($query) {
    //         $query->selectRaw(1)
    //         ->whereColumn('received', '>=', DB::raw('`total_price` - `discount_amount`'));
    //     };

    //     return Sale::where('received', '=', 0.00)->orWhereExists($raw);
        
    // }

    // public function scopeComplete($query) {
    //     $raw = function($query) {
    //         $query->selectRaw(1)
    //         ->whereColumn('received', '>=', DB::raw('`total_price` - `discount_amount`'));
    //     };
    //     return Sale::whereExists($raw);
    // }

    // public function scopeProducts($query) {

    //     $raw = $query->whereHas('details')->get()->flatMap(function($sale) {
    //         return $sale->details;
    //     })->groupBy('product_id');
    //     return $raw;
    // }

    // public function scopeCost($query) {
    //     $cost = $query->get()->sum('total_price');
    //     $discount = $query->get()->sum('discount_amount');

    //     $net = $cost - $discount;
    //     return floatval($net);
    // }
}
