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
            'id_type'                   => ['required', 'in:1,2'], // 1 = IC, 2 = Passport
            'ic_no'                     => ['nullable', 'string', 'max:50', 'required_if:id_type,1'],
            'passport_no'               => ['nullable', 'string', 'max:50', 'required_if:id_type,2'],
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

    public function messages(): array
    {
        return [
            'id_type.required' => 'ID type is required.',
            'id_type.in' => 'ID type must be either IC (1) or Passport (2).',
            'ic_no.required_if' => 'IC No is required when ID Type is IC.',
            'passport_no.required_if' => 'Passport No is required when ID Type is Passport.',
        ];
    }
}
