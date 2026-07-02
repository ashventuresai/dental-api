<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Interfaces\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $query = Patient::query();

        if (!empty($filters['search'])) {
            $search = trim((string) $filters['search']);

            $query->where(function ($builder) use ($search) {
                $builder->where('patient_uuid', 'like', '%' . $search . '%')
                    ->orWhere('firstname', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('ic_no', 'like', '%' . $search . '%')
                    ->orWhere('passport_no', 'like', '%' . $search . '%')
                    ->orWhere('contact_no', 'like', '%' . $search . '%');
            });
        }

        $perPage = (int) ($filters['per_page'] ?? 10);
        $perPage = max(1, min($perPage, 100));

        // ID is the indexed auto-increment column, much faster than sorting by string created_at.
        return $query->orderByDesc('ID')->paginate($perPage)->withQueryString();
    }

    public function findById($id)
    {
        return Patient::findOrFail($id);
    }

    public function create(array $data)
    {
        return Patient::create($data);
    }

    public function update($patient_uuid, array $data)
    {
        $patient = Patient::where('patient_uuid', $patient_uuid)->firstOrFail();
        $patient->fill($data);
        $patient->save();

        return $patient->refresh();
    }

    public function delete($patient_uuid)
    {
        $patient = Patient::where('patient_uuid', $patient_uuid)->firstOrFail();
        return $patient->delete();
    }
}
