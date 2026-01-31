<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class loginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ture;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'admin_email' => [
                'required',
                'string',
            ],
            'admin_password' => [
                'required',
                'string',
            ],
        ];
        return $rules;
    }

    public function messages()
    {
        $message = [
            'admin_email.required' => 'Please Enter Email Address',
            'admin_password.required' => 'Please Enter Password',
        ];
    return $message;
    }

}
