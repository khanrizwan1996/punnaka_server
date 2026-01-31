<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'user_name' => [
                'required',
                'string',
            ],
            'user_contact_no' => [
                'required'
            ],
            'user_email' => [
                'required',
                'string',
            ],
            'user_password' => [
                'required',
                'string',
            ],
            'user_country' => [
                'required',
                'string',
            ],
            'user_city' => [
                'required',
                'string',
            ],
            // 'user_pincode' => [
            //     'required',
            //     'string',
            // ],
            'user_address' => [
                'required',
                'string',
            ],
        ];
        return $rules;
    }

    public function messages()
    {
        $message = [
            'user_name.required' => 'Please Enter User Name',
            'user_contact_no.required' => 'Please Enter Mobile No',
            'user_email.required' => 'Please Enter Email Address',
            'user_password.required' => 'Please Enter Password',
            'user_country.required' => 'Please Enter Country',
            // 'user_pincode.required' => 'Please Enter Pin Code',
            'user_city.required' => 'Please Enter City',
            'user_address.required' => 'Please Enter Address',
        ];
    return $message;
    }
}
