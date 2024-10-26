<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerbandinganKriteriaRequest extends FormRequest
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
            'id1.*'     => 'required|exists:kriteria,id',
            'id2.*'     => 'required|exists:kriteria,id',
            'nilai.*'   => 'required|numeric|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'id1.*.required'    => 'Field ID1 tidak boleh kosong',
            'id2.*.required'    => 'Field ID2 tidak boleh kosong',
            'nilai.*.required'  => 'Field Nilai tidak boleh kosong',
            'nilai.*.numeric'   => 'Field Nilai harus berupa angka',
            'nilai.*.not_in'    => 'Field Nilai harus diisi',
        ];
    }
}
