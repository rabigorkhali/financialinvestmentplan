<?php

namespace App\Http\Requests\system;

use App\Rules\system\UniqueCaseSenstiveValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class roleRequest extends FormRequest
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
        $id = $this->route('role'); // Assuming your route parameter is named 'page'

        $validate = [
            'permissions' => 'required',
        ];

        if ($request->method() == 'POST') {
            $validate = array_merge($validate, [
                'name' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('roles', 'name')],
            ]);
        }
        if ($request->method() == 'PUT') {
            $validate = array_merge($validate, [
                'name' => ['required', 'string', 'max:255', new UniqueCaseSenstiveValidation('roles', 'name', $id)],
            ]);
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'name.required' => 'The role field is required.',
            'permissions.required' => 'Please select the permissions.',
        ];
    }
}
