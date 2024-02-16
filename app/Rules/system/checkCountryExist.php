<?php

namespace App\Rules\system;

use App\Model\Country;
use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
class checkCountryExist implements ValidationRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkExist = Country::find($value);
        if (!isset($checkExist)) {
            $fail('Please select the valid country.');
        }
    }
}
