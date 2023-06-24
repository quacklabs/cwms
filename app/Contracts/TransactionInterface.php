<?php
namespace App\Contracts;

use App\Models\Purchase;
use App\Models\Sale;

interface TransactionInterface {
    public function purchase(int $id): Purchase;
    public function sale(int $id): Sale;
}

interface Transaction {
    public function payable(): float;
    public function due(): float;
}