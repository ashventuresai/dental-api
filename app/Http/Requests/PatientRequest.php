<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname'                 => ['required', 'string', 'max:100'],
            'lastname'                  => ['required', 'string', 'max:100'],
            'middlename'                => ['nullable', 'string', 'max:100'],
            'id_type'                   => ['required', 'string', 'max:50'], // e.g. IC, Passport
            'ic_no'                     => ['required', 'string', 'max:50'],
            'passport_no'               => ['nullable', 'string', 'max:50'],
            'addressline1'              => ['nullable', 'string', 'max:255'],
            'addressline2'              => ['nullable', 'string', 'max:255'],
            'postalcode'                => ['nullable', 'string', 'max:20'],
            'city'                      => ['nullable', 'string', 'max:100'],
            'state'                     => ['nullable', 'string', 'max:100'],
            'country'                   => ['nullable', 'string', 'max:100'],
            'sex'                       => ['required', 'in:Male,Female,Other'],
            'age'                       => ['required', 'integer', 'min:0', 'max:150'],
            'date_of_birth'             => ['required', 'date'],
            'contact_no'                => ['required', 'string', 'max:20'],
            'emergency_name_1'          => ['required', 'string', 'max:100'],
            'emergency_phone_1'         => ['required', 'string', 'max:100'],
            'emergency_relationship_1'  => ['required', 'string', 'max:100'],
            'emergency_name_2'          => ['nullable', 'string', 'max:100'],
            'emergency_phone_2'         => ['nullable', 'string', 'max:100'],
            'emergency_relationship_2'  => ['nullable', 'string', 'max:100']
        ];
    }
}
