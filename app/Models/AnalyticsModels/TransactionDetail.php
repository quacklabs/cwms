<?php
namespace App\Models\AnalyticsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Contracts\TransactionInterface;
use App\Models\Sale;
use App\Models\Purchase;

abstract class TransactionDetail extends Model {
    
    abstract public function transaction(): BelongsTo;
    abstract public function product(): BelongsTo;
}