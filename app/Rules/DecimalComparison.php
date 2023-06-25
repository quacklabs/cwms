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
