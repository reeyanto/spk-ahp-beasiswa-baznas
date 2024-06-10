<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:5|max:25',
            'password' => 'required|string|min:8'
        ];
    }

    public function messages() {
        return [
            'username.required' => 'Field username tidak boleh kosong',
            'username.min' => 'Field username minimal 5 karakter',
            'username.max' => 'Field username maksimal 25 karakter',
            'password.required' => 'Field password tidak boleh kosong',
            'password.min' => 'Field password minimal 8 karakter',
        ];
    }
}
