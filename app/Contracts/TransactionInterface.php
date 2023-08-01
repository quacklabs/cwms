<?php
namespace App\Contracts;

// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;

// use App\Models\AnalyticsModels\TransactionDetail;


interface TransactionInterface {
    public function details(): HasMany;
    public function payable(): float;
    public function due(): float;
    public function origin(): Model;
}