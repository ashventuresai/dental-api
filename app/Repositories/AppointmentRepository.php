<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use App\DTO\Appointment\CreateAppointmentDTO;
use App\DTO\Appointment\UpdateAppointmentDTO;

use Illuminate\Support\Str;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function getAll()
    {
        return Appointment::with(['patient', 'staff', 'invoice.items'])->latest()->paginate(10);
    }

    public function findByUuid($appointment_uuid)
    {
        return Appointment::with(['patient', 'staff', 'treatment', 'invoice.items', 'invoice.payments'])
            ->where('appointment_uuid', $appointment_uuid)
            ->firstOrFail();
    }

    public function create(CreateAppointmentDTO $dto)
    {
        return Appointment::create([
            'appointment_uuid' => Str::uuid(),
            'patient_uuid' => $dto->patient_uuid,
            'staff_uuid' => $dto->staff_uuid,
            'patient_name' => $dto->patient_name,
            'patient_ic_no' => $dto->patient_ic_no,
            'appointment_datetime' => $dto->appointment_datetime,
            'status' => $dto->status,
            'reason' => $dto->reason,
            'notes' => $dto->notes,
            'patient_medical_problem' => $dto->patient_medical_problem,
            'patient_disease_history' => $dto->patient_disease_history,

        ]);
    }

    public function update($id, UpdateAppointmentDTO $dto)
    {
        $appt = Appointment::findOrFail($id);
        $appt->update([
            'patient_uuid' => $dto->patient_uuid,
            'staff_uuid' => $dto->staff_uuid,
            'patient_name' => $dto->patient_name,
            'patient_ic_no' => $dto->patient_ic_no,
            'appointment_datetime' => $dto->appointment_datetime,
            'status' => $dto->status,
            'reason' => $dto->reason,
            'notes' => $dto->notes,
            'patient_medical_problem' => $dto->patient_medical_problem,
            'patient_disease_history' => $dto->patient_disease_history,
        ]);
        return $appt;
    }

    public function updateStatus($id, $status)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $status;
        $appointment->save();

        return $appointment;
    }

    public function delete($id)
    {
        return Appointment::destroy($id);
    }
}
