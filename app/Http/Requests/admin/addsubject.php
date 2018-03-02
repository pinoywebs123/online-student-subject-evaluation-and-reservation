<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class addsubject extends FormRequest
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
            'requisite_subject_code' => 'required|max:200',
            'requisite_subject_description' => 'required|max:200',
            'new_subject_code' => 'required|max:200',
            'new_subject_description' => 'required|max:200',
            'semester' => 'required|max:20',
            'department' => 'required|max:3'
        ];
    }
}
