<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'full_name'                     => ['required','string','max:100'],
            'position'                      => ['required','string','max:50'],
            'ic_no'                         => ['required','string','max:100'],
            'phone_no'                      => ['nullable','string','max:20'],
            'start_date'                    => ['nullable','date'],
            'start_date'                    => ['nullable','date','after_or_equal:start_date'],
            'marital_status'                => ['nullable','string','max:50'],
            'spouse_name'                   => ['nullable','string','max:100'],
            'spouse_ic'                     => ['nullable','string','max:30'],
            'spouse_phone_no'               => ['nullable','string','max:20'],
            'total_independants'            => ['nullable','integer'],
            'emergency_contact_name'        => ['nullable','string','max:100'],
            'emergency_contact_phone'       => ['nullable','string','max:20'],
            'status'                        => ['nullable','string','max:20'],
        ];

    }
}
