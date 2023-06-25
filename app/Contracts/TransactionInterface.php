<?php
namespace App\Contracts;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Spatie\Permission\Models\Role;

interface TransactionInterface {
    public static function purchase(int $id): Purchase;
    public static function sale(int $id): Sale;
    public function payable(): float;
    public function due(): float;
}