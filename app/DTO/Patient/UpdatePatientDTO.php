<?php

namespace App\DTO\Patient;

use App\Http\Requests\PatientRequest;

class UpdatePatientDTO
{
    public function __construct(
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly ?string $middlename,
        public readonly string $id_type,
        public readonly ?string $ic_no,
        public readonly ?string $passport_no,
        public readonly string $addressline1,
        public readonly string $addressline2,
        public readonly string $postalcode,
        public readonly string $city,
        public readonly string $state,
        public readonly string $country,
        public readonly string $sex,
        public readonly int $age,
        public readonly ?string $date_of_birth,
        public readonly string $contact_no,
        public readonly string $emergency_name_1,
        public readonly string $emergency_phone_1,
        public readonly string $emergency_relationship_1,
        public readonly ?string $emergency_name_2,
        public readonly ?string $emergency_phone_2,
        public readonly ?string $emergency_relationship_2
    ) {}

    public static function fromUpdateRequest(PatientRequest $request): self
    {

        return new self(
            firstname               : $request->firstname,
            lastname                : $request->lastname,
            middlename              : $request->middlename,
            id_type                 : $request->id_type,
            ic_no                   : $request->ic_no,
            passport_no             : $request->passport_no,
            addressline1            : $request->addressline1,
            addressline2            : $request->addressline2,
            postalcode              : $request->postalcode,
            city                    : $request->city,
            state                   : $request->state,
            country                 : $request->country,
            sex                     : $request->sex,
            age                     : $request->age,
            date_of_birth           : $request->date_of_birth,
            contact_no              : $request->contact_no,
            emergency_name_1        : $request->emergency_name_1,
            emergency_phone_1       : $request->emergency_phone_1,
            emergency_relationship_1: $request->emergency_relationship_1,
            emergency_name_2        : $request->emergency_name_2,
            emergency_phone_2       : $request->emergency_phone_2,
            emergency_relationship_2: $request->emergency_relationship_2,
        );

    }

    public function toArray(): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
            'id_type' => $this->id_type,
            'ic_no' => $this->ic_no,
            'passport_no' => $this->passport_no,
            'addressline1' => $this->addressline1,
            'addressline2' => $this->addressline2,
            'postalcode' => $this->postalcode,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'sex' => $this->sex,
            'age' => $this->age,
            'date_of_birth' => $this->date_of_birth,
            'contact_no' => $this->contact_no,
            'emergency_name_1' => $this->emergency_name_1,
            'emergency_phone_1' => $this->emergency_phone_1,
            'emergency_relationship_1' => $this->emergency_relationship_1,
            'emergency_name_2' => $this->emergency_name_2,
            'emergency_phone_2' => $this->emergency_phone_2,
            'emergency_relationship_2' => $this->emergency_relationship_2
        ];
    }
}
