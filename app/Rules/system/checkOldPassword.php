<?php

namespace App\Rules\system;

use App\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class checkOldPassword implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $profile = User::find(authUser()->id);
        if (! isset($profile)) {
            $fail("The old password didn't match.");
        }

        if (! Hash::check($value, $profile->password)) {
            $fail("The old password didn't match.");
        }
    }
}
