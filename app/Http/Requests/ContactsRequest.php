<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'title' => 'required',
            'price' => 'required',
            'quantity'=>'required',
            'images'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Required!',
            'price.required' => 'price is Required!',
            'quantity.required'=>'quantity is Required!',
            'images.required'=>'required'
        ];
    }
}
