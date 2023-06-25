<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

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