<?php

namespace App\Http\Requests\system;

use App\Rules\system\CheckOtpRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class setResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $data = $request->only('email','otp_code','password','password_confirmation');

        $validate = [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];

        if (array_key_exists('otp_code', $data)) {
            $otpRule = [
                'otp_code' => ['required', new CheckOtpRule($data['email'])],
            ];
            $validate = array_merge($validate, $otpRule);
        }

        return $validate;
    }
}
