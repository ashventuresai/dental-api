<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

use App\DTO\ConsentFormDTO;
use App\Models\ConsentForm;
use Illuminate\Support\Facades\DB;

class ConsentFormService
{
    /**
     * Store a new consent form.
     */
    public function create(ConsentFormDTO $dto): ConsentForm
    {
        $filePath = $this->storeSignature($dto->signature_base64);

        $store_consent = ConsentForm::create([
            'patient_name' => $dto->patient_name,
            'patient_ic_no' => $dto->patient_ic_no,
            'patient_dob' => $dto->patient_dob,
            'patient_occupation' => $dto->patient_occupation,
            'patient_status' => $dto->patient_status,
            'patient_sex' => $dto->patient_sex,
            'patient_address_line1' => $dto->patient_address_line1,
            'patient_address_line2' => $dto->patient_address_line2,
            'patient_address_postcode' => $dto->patient_address_postcode,
            'patient_address_state' => $dto->patient_address_state,
            'patient_address_country' => $dto->patient_address_country,
            'patient_contact_no' => $dto->patient_contact_no,
            'patient_relative_contact_no' => $dto->patient_relative_contact_no,
            'patient_home_contact_no' => $dto->patient_home_contact_no,
            'patient_office_contact_no' => $dto->patient_office_contact_no,
            'patient_medical_problem' => $dto->patient_medical_problem,
            'patient_disease_history' => $dto->patient_disease_history,
            'signature_path' => $filePath,
            'signed_at' => now(),
        ]);

        return $store_consent;
    }

    private function storeSignature(string $base64): string
    {
        $signature = str_replace('data:image/png;base64,', '', $base64);
        $signature = str_replace(' ', '+', $signature);

        $fileName = 'signatures/' . uniqid() . '.png';

        Storage::disk('public')->put($fileName, base64_decode($signature));

        return $fileName;
    }

    /**
     * Update an existing consent form.
     */
    public function update(ConsentForm $consentForm, ConsentFormDTO $dto): ConsentForm
    {
        return DB::transaction(function () use ($consentForm, $dto) {
            $consentForm->update($dto->toArray());

            return $consentForm->fresh();
        });
    }

    /**
     * Find consent form by ID.
     */
    public function find(int $id): ?ConsentForm
    {
        return ConsentForm::find($id);
    }

    /**
     * Delete consent form.
     */
    public function delete(ConsentForm $consentForm): bool
    {
        return DB::transaction(function () use ($consentForm) {
            return $consentForm->delete();
        });
    }
}
