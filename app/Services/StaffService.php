<?php

namespace App\Services;

use App\Models\Staff;
use App\DTO\Staff\CreateStaffDTO;
use App\DTO\Staff\UpdateStaffDTO;
use Illuminate\Support\Str;

class StaffService
{
    public function getAll($search = null)
    {
        return Staff::query()
            ->when($search, function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                  ->orWhere('staff_id', 'like', "%$search%")
                  ->orWhere('ICNumber', 'like', "%$search%");
            })
            ->orderBy('id', 'desc')
            ->get();
    }

    public function findByUUID(string $uuid)
    {
        return Staff::where('staff_uuid', $uuid)->firstOrFail();
    }

    public function create(CreateStaffDTO $dto)
    {
        return Staff::create([
            'staff_uuid'                    => Str::uuid(),
            'staff_id'                      => $dto->staff_id,
            'full_name'                     => $dto->full_name,
            'position'                      => $dto->position,
            'ic_no'                         => $dto->ic_no,
            'phone_no'                      => $dto->phone_no,
            'start_date'                    => $dto->start_date,
            'end_date'                      => $dto->end_date,
            'marital_status'                => $dto->marital_status,
            'spouse_name'                   => $dto->spouse_name,
            'spouse_ic'                     => $dto->spouse_ic,
            'spouse_phone_no'               => $dto->spouse_phone_no,
            'total_independants'            => $dto->total_independants,
            'emergency_contact_name'        => $dto->emergency_contact_name,
            'emergency_contact_phone'       => $dto->emergency_contact_phone,
            'status'                        => $dto->status
        ]);
    }

    public function update(string $uuid, UpdateStaffDTO $dto)
    {
        $staff = $this->findByUUID($uuid);

        $staff->update([
            'full_name'                     => $dto->full_name,
            'position'                      => $dto->position,
            'ic_no'                         => $dto->ic_no,
            'phone_no'                      => $dto->phone_no,
            'start_date'                    => $dto->start_date,
            'end_date'                      => $dto->end_date,
            'marital_status'                => $dto->marital_status,
            'spouse_name'                   => $dto->spouse_name,
            'spouse_ic'                     => $dto->spouse_ic,
            'spouse_phone_no'               => $dto->spouse_phone_no,
            'total_independants'            => $dto->total_independants,
            'emergency_contact_name'        => $dto->emergency_contact_name,
            'emergency_contact_phone'       => $dto->emergency_contact_phone,
            'status'                        => $dto->status
        ]);

        return $staff;
    }

    public function delete(string $uuid)
    {
        return Staff::where('staff_uuid', $uuid)->delete();
    }
}
