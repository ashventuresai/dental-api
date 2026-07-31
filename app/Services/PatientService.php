<?php

namespace App\Services;

use App\Repositories\Interfaces\PatientRepositoryInterface;
use Carbon\Carbon;

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

    public function getPatient(array $filters)
    {
        validator($filters, [
            'q' => 'required|string|min:2|max:100',
            'limit' => 'nullable|integer|min:1|max:20'
        ])->validate();

        $patients = $this->patientRepo->getPatientByNameAndIC($filters);

        return $patients->map(function ($patient) {

            return [
                'nama_pesakit' => trim($patient->firstname . ' ' . $patient->middlename . ' ' . $patient->lastname),
                'no_ic' => $patient->ic_no,
                'tarikh_lahir' => $patient->date_of_birth
                    ? Carbon::parse($patient->date_of_birth)->format('Y-m-d')
                    : null,
                'umur' => $patient->age,
                'jantina' => $patient->sex === 'Male' ? 'LELAKI' : 'PEREMPUAN',
                'no_tel_bimbit' => $patient->contact_no,
                'no_tel_waris' => $patient->emergency_phone_1,
                'alamat1' => $patient->addressline1,
                'alamat2' => $patient->addressline2,
                'poskod' => $patient->postalcode,
                'bandar' => $patient->city,
                'negeri' => $patient->state,
                'negara' => $patient->country ?? 'Malaysia',
            ];

        });
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
