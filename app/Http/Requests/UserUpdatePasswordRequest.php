<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // hanya yang sudah login yg bisa ubah password
        return auth()->check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ];
    }

    public function messages() {
        return [
            'password.required' => 'Field password tidak boleh kosong',
            'password.min' => 'Field password minimal 8 karakter',
            'password_confirmation.required' => 'Field konfirmasi password tidak boleh kosong',
            'password_confirmation.min' => 'Field konfirmasi password minimal 8 karakter',
        ];
    }
}
