<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KriteriaRequest extends FormRequest
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
            'nama' => 'required|string|min:2,max:255',
            'keterangan' => 'nullable'
        ];
    }

    public function messages() {
        return [
            'nama.required' => 'Field nama kriteria tidak boleh kosong',
            'nama.min' => 'Field nama kriteria minimal 2 karakter',
            'nama.max' => 'Field nama kriteria maksimal 255 karakter'
        ];
    }
}
