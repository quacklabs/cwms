<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Customer;
use App\Models\Sale;

use Carbon\Carbon;

class CustomerPayment extends Model
{
    protected $table = 'customer_payment';

    protected $casts= [
        'date' => 'datetime:d-m-Y'
    ];

    protected $fillable = [
        'sale_id', 'customer_id', 'sale_return_id',
        'amount', 'trx', 'remarks'
    ];

    public function owner() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getDateAttribute() {
        return Carbon::parse($this->created_at)->toDateString();
    }

    public function transaction() {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
