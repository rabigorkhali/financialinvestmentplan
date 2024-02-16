<?php

namespace App\Rules\system;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ConfigRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
