<?php

namespace App\DTO\Treatment;

class UpdateTreatmentDTO
{
     public function __construct(
        public readonly string $appointment_uuid,
        public readonly string $patient_uuid,
        public readonly string $staff_uuid,

        public readonly ?string $chief_complaint,
        public readonly ?string $history_of_complaint,
        public readonly ?string $past_medical_history,
        public readonly ?string $past_dental_history,
        public readonly ?string $extra_intra_oral_examination,
        public readonly ?string $radiographic_examination,
        public readonly ?string $diagnosis,
        public readonly ?string $treatment,
        public readonly ?string $notes,

        public readonly bool $need_follow_up,
        public readonly ?string $follow_up_date,

        public readonly string $status,
    ) {}

    public static function fromUpdateRequest(array $data): self
    {
        return new self(
            $data['appointment_uuid'],
            $data['patient_uuid'],
            $data['staff_uuid'],

            $data['chief_complaint'] ?? null,
            $data['history_of_complaint'] ?? null,
            $data['past_medical_history'] ?? null,
            $data['past_dental_history'] ?? null,
            $data['extra_intra_oral_examination'] ?? null,
            $data['radiographic_examination'] ?? null,
            $data['diagnosis'] ?? null,
            $data['treatment'] ?? null,
            $data['notes'] ?? null,

            $data['need_follow_up'] ?? false,
            $data['follow_up_date'] ?? null,

            $data['status'],
        );
    }
}
