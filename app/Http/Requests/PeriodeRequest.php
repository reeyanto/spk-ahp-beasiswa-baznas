<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodeRequest extends FormRequest
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
            'nama' => 'required|string|min:2,max:50',
            'tahun' => 'required|digits:4',
            'keterangan' => 'nullable'
        ];
    }

    public function messages() {
        return [
            'nama.required' => 'Field nama tidak boleh kosong',
            'nama.min' => 'Field periode minimal 2 karakter',
            'nama.max' => 'Field periode maksimal 50 karakter',
            'tahun.required' => 'Field tahun tidak boleh kosong',
            'tahun.digits' => 'Field tahun harus 4 digit angka'
        ];
    }
}
