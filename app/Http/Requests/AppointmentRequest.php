<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use App\Enums\AppointmentStatus;

class AppointmentRequest extends FormRequest
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
            'staff_uuid'            => ['required', 'string'],
            'patient_uuid'          => ['required', 'string'],
            'consent_uuid'          => ['nullable', 'string'],
            'patient_name'          => ['required', 'string', 'max:90'],
            'patient_ic_no'         => ['required', 'string', 'max:90'],
            'appointment_datetime'  => ['required', 'date_format:Y-m-d H:i:s'],
            'status'                => ['required', Rule::enum(AppointmentStatus::class)],
            'end_appointment'       => ['nullable', 'date_format:Y-m-d H:i:s'],
            'reason'                => ['nullable', 'string', 'max:255'],
            'notes'                 => ['nullable', 'string', 'max:255'],
            'patient_medical_problem' => ['nullable', 'string', 'max:255'],
            'patient_disease_history' => ['nullable', 'string', 'max:255'],
        ];
    }
}
