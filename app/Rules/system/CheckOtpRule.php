<?php

namespace App\Rules\system;

use App\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class CheckOtpRule implements ValidationRule
{
    public function __construct($email)
    {
        $this->email = $email;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', $this->email)->where('otp_code', $value)->exists();
        if (!$user) {
            $fail('Invalid otp code.');
        }
    }
}
