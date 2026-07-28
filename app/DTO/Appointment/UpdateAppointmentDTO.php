<?php

namespace App\DTO\Appointment;

use App\Http\Requests\AppointmentRequest;

class UpdateAppointmentDTO
{
    public function __construct(
        public readonly string $patient_uuid,
        public readonly string $staff_uuid,
        public readonly ?string $consent_uuid,
        public readonly string $patient_name,
        public readonly string $patient_ic_no,
        public readonly string $appointment_datetime,
        public readonly string $status,
        public readonly ?string $notes,
        public readonly ?string $reason,
        public readonly ?string $patient_medical_problem,
        public readonly ?string $patient_disease_history,
    ) {}

    public static function fromUpdateRequest(AppointmentRequest $request): self
    {
       return new self(
            patient_uuid: $request->patient_uuid,
            staff_uuid: $request->staff_uuid,
            consent_uuid: $request->consent_uuid ?? null,
            patient_name: $request->patient_name,
            patient_ic_no: $request->patient_ic_no,
            appointment_datetime: $request->appointment_datetime,
            status: $request->status,
            reason: $request->reason,
            notes: $request->notes ?? null,
            patient_medical_problem: $request->patient_medical_problem ?? null,
            patient_disease_history: $request->patient_disease_history ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'staff_uuid' => $this->staff_uuid,
            'patient_uuid' => $this->patient_uuid,
            'consent_uuid' => $this->consent_uuid,
            'patient_name' => $this->patient_name,
            'patient_ic_no' => $this->patient_ic_no,
            'appointment_datetime' => $this->appointment_datetime,
            'status' => $this->status,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'patient_medical_problem' => $this->patient_medical_problem,
            'patient_disease_history' => $this->patient_disease_history
        ];
    }
}
