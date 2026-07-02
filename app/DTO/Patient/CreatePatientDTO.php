<?php

namespace App\DTO\Patient;

use App\Http\Requests\PatientRequest;
use Illuminate\Support\Str;

class CreatePatientDTO
{
    public function __construct(
        public readonly string $patient_uuid,
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly string $middlename,
        public readonly string $id_type,
        public readonly string $ic_no,
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

    public static function fromCreateRequest(PatientRequest $request): self
    {
        $data = $request->validated();

        return new self(
            patient_uuid: (string) Str::uuid(),
            firstname: $data['firstname'] ?? '',
            lastname: $data['lastname'] ?? '',
            middlename: $data['middlename'] ?? '',
            id_type: $data['id_type'] ?? '',
            ic_no: $data['ic_no'] ?? '',
            passport_no: $data['passport_no'] ?? '',
            addressline1: $data['addressline1'] ?? '',
            addressline2: $data['addressline2'] ?? '',
            postalcode: $data['postalcode'] ?? '',
            city: $data['city'] ?? '',
            state: $data['state'] ?? '',
            country: $data['country'] ?? '',
            sex: $data['sex'] ?? '',
            age: $data['age'] ?? 0,
            date_of_birth: $data['date_of_birth'] ?? now()->format('Y-m-d'),
            contact_no: $data['contact_no'] ?? '',
            emergency_name_1: $data['emergency_name_1'] ?? '',
            emergency_phone_1: $data['emergency_phone_1'] ?? '',
            emergency_relationship_1: $data['emergency_relationship_1'] ?? '',
            emergency_name_2: $data['emergency_name_2'] ?? '',
            emergency_phone_2: $data['emergency_phone_2'] ?? '',
            emergency_relationship_2: $data['emergency_relationship_2'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'patient_uuid' => $this->patient_uuid,
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
