<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlternatifRequest extends FormRequest
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
            'periode_id' => 'required|exists:periode,id',
            'nama' => 'required|string|min:3|max:100',
            'alamat' => 'required|string|min:1|max:255',
            'hp' => 'required|digits_between:11,13',
            'jk' => 'required|string|in:L,P'
        ];
    }

    public function messages() {
        return [
            'periode_id.required' => 'Field periode tidak boleh kosong',
            'periode_id.exists' => 'Field periode harus sudah ada pada data periode',
            'nama.required' => 'Field nama tidak boleh kosong',
            'nama.min' => 'Field nama minimal 3 karakter',
            'nama.max' => 'Field nama maksimal 100 karakter',
            'alamat.required' => 'Field alamat tidak boleh kosong',
            'alamat.min' => 'Field alamat minimal 1 karakter',
            'alamat.max' => 'Field alamat maksimal 255 karakter',
            'hp.required' => 'Field HP tidak boleh kosong',
            'hp.digits_between' => 'Field HP minimal 11 digit dan maksimal 13 digit',
            'jk.required' => 'Field jenis kelamin tidak boleh kosong',
            'jk.in' => 'Field jenis kelamin harus L (Laki-laki) atau P (Perempuan)'
        ];
    }
}
