<?php

namespace App\Enums;
use BenSampo\Enum\Enum;


abstract class BaseEnum extends Enum {

    public static function fromString(string $value): ?string
    {
        if (in_array($value, self::getValues())) {
            return $value;
        }
        return null;
    }
    
    public static function isEqual(string $value1, string $value2): bool
    {
        return self::fromString($value1) === $value2;
    }
}