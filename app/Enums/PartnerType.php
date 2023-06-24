<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use App\Enums\BaseEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 */
final class PartnerType extends BaseEnum
{
    const CUSTOMER =  'customer';
    const SUPPLIER =   'supplier';
}
