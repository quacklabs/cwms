<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use App\Enums\BaseEnum;


final class TransferType extends BaseEnum {
    const WAREHOUSE_STORE = 'WAREHOUSE_STORE';
    const WAREHOUSE_WAREHOUSE = 'WAREHOUSE_WAREHOUSE';
    const STORE_STORE = "STORE_STORE";
    const STORE_WAREHOUSE = "STORE_WAREHOUSE";
}