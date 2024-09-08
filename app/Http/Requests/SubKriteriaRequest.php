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
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama' => 'required',
            'keterangan' => 'nullable|string|min:3|max:25'
        ];
    }

    public function messages() {
        return [
            'kriteria_id.required'  => 'Pilih nama kriteria',
            'kriteria_id.exists'    => 'Pilih nama kriteria',
            'nilai.required'        => 'Field nilai tidak boleh kosong',
            'nama.required'         => 'Field nama tidak boleh kosong',
        ];
    }
}
