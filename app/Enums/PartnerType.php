<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 */
final class PartnerType extends Enum
{
    const CUSTOMER =  'customer';
    const SUPPLIER =   'supplier';

    public static function fromString(string $value): ?string
    {
        if (in_array($value, PartnerType::getValues())) {
            return $value;
        }
        return null;
    }
    
    public static function isEqual(string $value1, string $value2): bool
    {
        return PartnerType::fromString($value1) === $value2;
    }
}
