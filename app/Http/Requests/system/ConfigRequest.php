<?php

namespace App\Http\Requests\system;

use App\Model\Config;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ConfigRequest extends FormRequest
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
        $config = Config::find($request->config);

        $validate = [
            'label' => 'required|unique:configs,label',
            'type' => 'required|in:text,textarea,file,number',
        ];

        if ($config) {
            $inputName = str_replace(' ', '_', $config->label);
            if ($request->method() != 'POST') {
                $validate = [
                    $inputName => ($config->label == 'cms title') ? 'nullable' : 'required'
                ];

                if ($config->type == 'file') {
                    $validate[$inputName] .= '|image|mimes:jpg,png,jpeg,bmp';
                }
            } elseif ($request->type == 'file') {
                $validate['value'] .= '|image|mimes:jpg,png,jpeg,bmp';
            } else {
                $validate['value'] = 'required';
            }
        }

        return $validate;

    }
}
