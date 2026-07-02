<?php

namespace App\Repositories;

use App\Models\Treatment;
use App\DTO\Treatment\CreateTreatmentDTO;
use App\DTO\Treatment\UpdateTreatmentDTO;
use App\Repositories\Interfaces\TreatmentRepositoryInterface;

class TreatmentRepository implements TreatmentRepositoryInterface
{
    public function create(CreateTreatmentDTO $dto)
    {
        return Treatment::create([
            'appointment_uuid' => $dto->appointment_uuid,
            'patient_uuid' => $dto->patient_uuid,
            'staff_uuid' => $dto->staff_uuid,

            'chief_complaint' => $dto->chief_complaint,
            'history_of_complaint' => $dto->history_of_complaint,
            'past_medical_history' => $dto->past_medical_history,
            'past_dental_history' => $dto->past_dental_history,
            'extra_intra_oral_examination' => $dto->extra_intra_oral_examination,
            'radiographic_examination' => $dto->radiographic_examination,
            'diagnosis' => $dto->diagnosis,
            'treatment' => $dto->treatment,
            'notes' => $dto->notes,

            'need_follow_up' => $dto->need_follow_up,
            'follow_up_date' => $dto->follow_up_date,
            'status' => $dto->status,
        ]);
    }

    public function update(string $uuid, UpdateTreatmentDTO $dto)
    {
        $treatment = Treatment::findOrFail($uuid);

        $treatment->update([
            'appointment_uuid' => $dto->appointment_uuid,
            'patient_uuid' => $dto->patient_uuid,
            'staff_uuid' => $dto->staff_uuid,

            'chief_complaint' => $dto->chief_complaint,
            'history_of_complaint' => $dto->history_of_complaint,
            'past_medical_history' => $dto->past_medical_history,
            'past_dental_history' => $dto->past_dental_history,
            'extra_intra_oral_examination' => $dto->extra_intra_oral_examination,
            'radiographic_examination' => $dto->radiographic_examination,
            'diagnosis' => $dto->diagnosis,
            'treatment' => $dto->treatment,
            'notes' => $dto->notes,

            'need_follow_up' => $dto->need_follow_up,
            'follow_up_date' => $dto->follow_up_date,
            'status' => $dto->status,
        ]);

        return $treatment;
    }

    public function findByUuid($uuid)
    {
        return Treatment::with(['patient','staff'])->findOrFail($uuid);
        // return Treatment::where('treatment_uuid', $uuid)->firstOrFail();
    }
}
