<?php

namespace App\DTO;

use App\Http\Requests\ConsentFormRequest;
use Carbon\CarbonInterface;

class ConsentFormDTO
{
    public function __construct(
        public ?string $patient_name,
        public ?string $patient_ic_no,
        public ?string $patient_dob,
        public ?string $patient_occupation,
        public ?string $patient_status,
        public ?string $patient_sex,
        public ?string $patient_address_line1,
        public ?string $patient_address_line2,
        public ?string $patient_address_postcode,
        public ?string $patient_address_city,
        public ?string $patient_address_country,
        public ?string $patient_address_state,
        public ?string $patient_contact_no,
        public ?string $patient_relative_contact_no,
        public ?string $patient_home_contact_no,
        public ?string $patient_office_contact_no,
        public ?string $patient_medical_problem,
        public ?string $patient_disease_history,
        public string $signature_base64,
    ) {}

    public static function fromRequest(ConsentFormRequest $request): self
    {
        $data = $request->input('form_data', []);

        return new self(
            patient_name: $data['nama_pesakit'] ?? null,
            patient_ic_no: $data['no_ic'] ?? null,
            patient_dob: $data['tarikh_lahir'] ?? null,
            patient_occupation: $data['pekerjaan'] ?? null,
            patient_status: $data['status'] ?? null,
            patient_sex: $data['jantina'] ?? null,

            patient_address_line1: $data['alamat1'] ?? null,
            patient_address_line2: $data['alamat2'] ?? null,
            patient_address_postcode: $data['poskod'] ?? null,
            patient_address_city: $data['bandar'] ?? null,
            patient_address_state: $data['negeri'] ?? null,
            patient_address_country: $data['negara'] ?? null,

            patient_contact_no: $data['no_tel_bimbit'] ?? null,
            patient_relative_contact_no: $data['no_tel_waris'] ?? null,
            patient_home_contact_no: $data['no_tel_rumah'] ?? null,
            patient_office_contact_no: $data['no_tel_pejabat'] ?? null,

            patient_medical_problem: $data['masalah_perubatan'] ?? null,
            patient_disease_history: $data['sejarah_penyakit'] ?? null,

            signature_base64: $request->signature,
        );
    }

    public function toArray(): array
    {
        return [
            'patient_name' => $this->patient_name,
            'patient_ic_no' => $this->patient_ic_no,
            'patient_dob' => $this->patient_dob,
            'patient_occupation' => $this->patient_occupation,
            'patient_status' => $this->patient_status,
            'patient_sex' => $this->patient_sex,
            'patient_address_line1' => $this->patient_address_line1,
            'patient_address_line2' => $this->patient_address_line2,
            'patient_address_postcode' => $this->patient_address_postcode,
            'patient_address_city' => $this->patient_address_city,
            'patient_address_country' => $this->patient_address_country,
            'patient_address_state' => $this->patient_address_state,
            'patient_contact_no' => $this->patient_contact_no,
            'patient_relative_contact_no' => $this->patient_relative_contact_no,
            'patient_home_contact_no' => $this->patient_home_contact_no,
            'patient_office_contact_no' => $this->patient_office_contact_no,
            'patient_medical_problem' => $this->patient_medical_problem,
            'patient_disease_history' => $this->patient_disease_history,
            'signature_base64' => $this->signature,
        ];
    }
}
