<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registration extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:1|max:100|regex:/^[a-zA-Z0-9\s]*$/',
            'email' => 'required|email|unique:users',
            'password' => [
             'required',
             'min:8'],
             # 'required_with:confirm_password', 'same:confirm_password',
        ];
    }
}
