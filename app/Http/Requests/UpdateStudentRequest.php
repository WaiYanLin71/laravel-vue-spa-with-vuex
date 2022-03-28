<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'name' => ['required','max:50','min:4'],
            'email' => ['required','email', Rule::unique('students')->ignore($this->route()->id)],
            'image' => ['nullable','sometimes','image','mimes:jpeg,png,jpg,gif,svg','max:2025']
        ];
    }
}
