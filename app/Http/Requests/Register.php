<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required',
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'mobile_no' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'email.required' => 'required',
            'username.required' => 'Username is Required!',
            'username.regex' => 'Name format',
            'mobile_no.required' => 'Mobile No is Required!',
            'password.required' => 'password is Required!',
            'password.min' => 'Username minlength 6',
            'password_confirmation.required' => 'confirmation Password  Required',
            'password_confirmation.same' => 'password confirmation not same'
        ];
    }
}
