<?php

namespace App\Http\Requests\system;

use App\Rules\system\checkOldPassword;
use App\Rules\system\UniqueCaseSenstiveValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class profileRequest extends FormRequest
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

        $id = $request->id; // Assuming your route parameter is named 'page'

        return [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('users', 'username', $id)],
            'email' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('users', 'email', $id)],
            'contact' => ['required', 'numeric', 'digits:10', new UniqueCaseSenstiveValidation('users', 'contact', $id)],
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
