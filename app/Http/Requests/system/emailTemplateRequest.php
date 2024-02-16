<?php

namespace App\Http\Requests\system;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class emailTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
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
        $validate = [
            'title' => 'required',
            'from' => 'email',
            'multilingual.*.subject' => 'required',
            'multilingual.*.template' => 'required',
        ];

        if ($request->method() == 'POST') {
            $validate = array_merge($validate, [
                'code' => 'required|unique:email_templates,code',
            ]);
        }

        if ($request->method() == 'PUT') {
            $validate = array_merge($validate, [
                'code' => 'required|unique:email_templates,code,'.$request->email_template,
            ]);
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'multilingual.*.subject.required' => 'The subject field is required.',
            'multilingual.*.template.required' => 'The template field is required.',
        ];
    }
}
