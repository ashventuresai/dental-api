<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ConsentFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'form_data' => 'required|array',

            // Identity
            'form_data.nama_pesakit' => ['nullable', 'string', 'max:90'],
            'form_data.no_ic' => ['nullable', 'string', 'max:90'],
            'form_data.tarikh_lahir' => ['nullable', 'date'],
            'form_data.pekerjaan' => ['nullable', 'string', 'max:90'],
            'form_data.status' => ['nullable', 'string', 'max:90'],
            'form_data.jantina' => ['nullable', 'string', 'max:90'],

            // Address
            'form_data.alamat1' => ['nullable', 'string', 'max:255'],
            'form_data.alamat2' => ['nullable', 'string', 'max:255'],
            'form_data.poskod' => ['nullable', 'string', 'max:90'],
            'form_data.bandar' => ['nullable', 'string', 'max:90'],
            'form_data.negeri' => ['nullable', 'string', 'max:90'],
            'form_data.negara' => ['nullable', 'string', 'max:90'],

            // Contacts
            'form_data.no_tel_bimbit' => ['nullable', 'string', 'max:90'],
            'form_data.no_tel_waris' => ['nullable', 'string', 'max:90'],
            'form_data.no_tel_rumah' => ['nullable', 'string', 'max:90'],
            'form_data.no_tel_pejabat' => ['nullable', 'string', 'max:90'],

            // Medical
            'form_data.masalah_perubatan' => ['nullable', 'string', 'max:255'],
            'form_data.sejarah_penyakit' => ['nullable', 'string', 'max:255'],

            'signature' => 'required|string',
        ];
    }
}
