<?php

namespace App\DTO\Staff;

use App\Http\Requests\StaffRequest;

class UpdateStaffDTO
{
    public function __construct(
        public readonly string $full_name,
        public readonly string $position,
        public readonly string $ic_no,
        public readonly ?string $phone_no,
        public readonly ?string $start_date,
        public readonly ?string $end_date,
        public readonly ?string $marital_status,
        public readonly ?string $spouse_name,
        public readonly ?string $spouse_ic,
        public readonly ?string $spouse_phone_no,
        public readonly int $total_independants,
        public readonly ?string $emergency_contact_name,
        public readonly ?string $emergency_contact_phone,
        public readonly ?string $status
    ) {}

    public static function fromUpdateRequest(StaffRequest $request): self
    {
        return new self(
            full_name: $request->full_name,
            position: $request->position,
            ic_no: $request->ic_no,
            phone_no: $request->phone_no,
            start_date: $request->start_date,
            end_date: $request->end_date,
            marital_status: $request->marital_status,
            spouse_name: $request->spouse_name,
            spouse_ic: $request->spouse_ic,
            spouse_phone_no: $request->spouse_phone_no,
            total_independants: $request->total_independants ?? 0,
            emergency_contact_name: $request->emergency_contact_name,
            emergency_contact_phone: $request->emergency_contact_phone,
            status: $request->status ?? 'ACTIVE'
        );
    }

}
