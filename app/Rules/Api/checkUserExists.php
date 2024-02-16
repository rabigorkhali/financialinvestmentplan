<?php

namespace App\Rules\Api;

use App\Model\FrontendUser;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class checkUserExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
        $this->frontendUser = new FrontendUser();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = $this->frontendUser->where('email', $value)->first();
        if (isset($user) && Hash::check($this->password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User not found';
    }
}
