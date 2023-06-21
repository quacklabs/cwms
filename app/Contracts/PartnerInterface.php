<?php
namespace App\Contracts;
use App\Models\Customer;
use App\Models\Supplier;

interface PartnerInterface {
    public function supplier(int $id): Supplier;
    public function customer(int $id): Customer;
}
