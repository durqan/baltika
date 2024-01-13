<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AddEditProductRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function rules()
    {
        return [
            'article' => 'required',
            'name' => 'required|min:10|alpha_dash:ascii'
        ];
    }

    public function messages()
    {
        return [
            'article.required' => 'Артикул обязателен к заполнению',
            'name.required' => 'Название обязательно к заполнению',
            'name.min' => 'Название должно содержать минимум 10 символов',
            'alpha_dash' => 'Название должно содержать только латинские буквы и цифры'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $validator->errors()->first();
    }
}
