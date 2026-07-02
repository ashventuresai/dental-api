<?php

namespace App\Repositories\Interfaces;

use App\DTO\Appointment\CreateAppointmentDTO;
use App\DTO\Appointment\UpdateAppointmentDTO;

interface AppointmentRepositoryInterface
{
    public function getAll();
    public function findByUuid($appointment_uuid);
    public function create(CreateAppointmentDTO $dto);
    public function update($id, UpdateAppointmentDTO $dto);
    public function updateStatus($id, $status);
    public function delete($id);
}
