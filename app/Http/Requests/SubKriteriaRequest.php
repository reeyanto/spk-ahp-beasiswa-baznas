<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubKriteriaRequest extends FormRequest
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
            'kriteria_id' => 'required',
            'nilai'       => 'required',
            'bobot'       => 'required|numeric|min:0|max:9'
        ];
    }

    public function messages() {
        return [
            'kriteria_id.required'  => 'Pilih nama kriteria',
            'nilai.required'        => 'Field nilai tidak boleh kosong',
            'bobot.required'        => 'Field bobot tidak boleh kosong',
            'bobot.numeric'         => 'Field bobot harus berupa angka',
            'bobot.min'             => 'Field bobot harus berupa angka antara 0 sampai 9',
            'bobot.max'             => 'Field bobot harus berupa angka antara 0 sampai 9'
        ];
    }
}
