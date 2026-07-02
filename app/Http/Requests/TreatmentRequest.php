<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TreatmentRequest extends FormRequest
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
            'appointment_uuid' => ['required', 'uuid'],
            'patient_uuid' => ['required', 'uuid'],
            'staff_uuid' => ['required', 'uuid'],

            'chief_complaint' => ['nullable', 'string'],
            'history_of_complaint' => ['nullable', 'string'],
            'past_medical_history' => ['nullable', 'string'],
            'past_dental_history' => ['nullable', 'string'],
            'extra_intra_oral_examination' => ['nullable', 'string'],
            'radiographic_examination' => ['nullable', 'string'],
            'diagnosis' => ['nullable', 'string'],
            'treatment' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],

            'need_follow_up' => ['boolean'],
            'follow_up_date' => ['nullable', 'date'],

            'status' => ['required', 'in:Draft,Ongoing,Completed,Cancelled'],
        ];
    }
}
