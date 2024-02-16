<?php

namespace App\Http\Requests\system;

use App\Rules\system\UniqueCaseSenstiveValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class userRequest extends FormRequest
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
        $id = $this->route('user'); // Assuming your route parameter is named 'page'

        $validate = [
            'name' => 'required|string|min:3|max:255',
            'role_id' => 'required',
        ];

        if ($request->method() == 'POST') {
            $validate = array_merge($validate, [
                'username' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('users', 'username')],
                'email' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('users', 'email')],
            ]);
        }
        if ($request->method() == 'PUT') {
            $validate = array_merge($validate, [
                'username' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('users', 'username', $id)],
                'email' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('users', 'email', $id)],
            ]);
        }

        if ($request->set_password_status == 1) {
            $validate = array_merge($validate, [
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required',
            ]);
        }


        return $validate;
    }
}
