<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TransferDetail;
use App\Models\Warehouse;
use App\Models\Store;
use App\Traits\ActionTakenBy;
use App\Enums\TransferType;
use App\Contracts\GitWarehouse;

class Transfer extends Model
{
    use HasFactory, SoftDeletes, ActionTakenBy;
    protected $table = 'transfer';
    protected $fillable = [
        'tracking_no', 'from', 'to','type','transfer_date','note','balanced'
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

    public function source() {
        // dd($this->type);
        switch($this->type) {
            case TransferType::WAREHOUSE_STORE: case TransferType::WAREHOUSE_WAREHOUSE:
                return Warehouse::where('id', $this->from)->first();
            case TransferType::STORE_STORE: case TransferType::STORE_WAREHOUSE:
                return Store::where('id', $this->from)->first();
            case TransferType::GIT_WAREHOUSE: case TransferType::GIT_STORE:
                return new GitWarehouse();
        }
    }

    public function destination() {
        // dd($this->type);
        switch($this->type) {
            case TransferType::WAREHOUSE_STORE: case TransferType::STORE_STORE:
                return Store::where('id', $this->to)->first();
            case TransferType::WAREHOUSE_WAREHOUSE: case TransferType::STORE_WAREHOUSE:
                return Warehouse::where('id', $this->to)->first();
            case TransferType::GIT_WAREHOUSE: case TransferType::GIT_STORE:
                return new GitWarehouse();
        }
    }
}
