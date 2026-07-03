<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
            'service_name'              => ['required','string','max:100'],
            'service_category'          => ['nullable','string','max:50'],
            'service_price'             => ['required','integer','min:100'],
            'service_description'       => ['nullable','string','max:255'],
            'service_active'            => ['required','string','max:10'],
            'appointment_uuid'          => ['nullable', 'uuid', 'exists:tblappointments,appointment_uuid'],
        ];

    }
}
