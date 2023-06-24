<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use App\Enums\BaseEnum;


final class TransactionType extends BaseEnum {
    const PURCHASE = 'purchase';
    const SALE = 'sale';
}
