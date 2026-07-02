<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'appointment_uuid' => ['required', 'uuid', 'exists:tblappointments,appointment_uuid'],
            'patient_uuid' => ['required', 'uuid', 'exists:tblpatients,patient_uuid'],
            'treatment_uuid' => ['nullable', 'uuid', 'exists:tbltreatment,treatment_uuid'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_type' => ['nullable', 'string', 'in:procedure,medicine,consultation'],
            'items.*.description' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
