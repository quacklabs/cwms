<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DecimalComparison implements Rule
{
    protected $otherField;

    public function __construct($otherField)
    {
        $this->otherField = $otherField;
    }

    public function passes($attribute, $value)
    {
        $otherValue = request()->input($this->otherField);

        return bccomp(str_replace(',','',$value), str_replace(',','',$otherValue), 2) <= 0;
    }

    public function message()
    {
        return 'The :attribute cannot exceed the value of ' . $this->otherField . '.';
    }
}


class Decimal implements Rule {
    
    public function passes($attribute, $value){
        // Remove commas from the value
        $valueWithoutCommas = str_replace(',', '', $value);

        // Check if the value is a valid decimal number
        return is_numeric($valueWithoutCommas);
    }

    public function message()
    {
        return 'The :attribute must be a valid decimal number.';
    }
}