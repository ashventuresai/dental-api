<?php

namespace App\Services;

use App\Repositories\Interfaces\PatientRepositoryInterface;

class PatientService
{
    protected $patientRepo;

    public function __construct(PatientRepositoryInterface $patientRepo)
    {
        $this->patientRepo = $patientRepo;
    }

    public function getAllPatients(array $filters = [])
    {
        return $this->patientRepo->getAll($filters);
    }

    public function createPatient($data)
    {
        return $this->patientRepo->create($data);
    }

    public function updatePatient($patient_uuid, $data)
    {
        return $this->patientRepo->update($patient_uuid, $data);
    }

    public function deletePatient($patient_uuid)
    {
        return $this->patientRepo->delete($patient_uuid);
    }
}
