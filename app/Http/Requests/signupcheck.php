<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class signupcheck extends FormRequest
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
        return [

            'first_name' => 'required|max:20',
            'middle_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'contact' => 'required|max:12',
            'address' => 'required|max:100',
            'id' => 'required|max:20|unique:users',
            'course' => 'required|max:10',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|max:12',
            'repeat_password' => 'required|same:password',
            'g-recaptcha-response'=> 'required'
        ];
    }
}
