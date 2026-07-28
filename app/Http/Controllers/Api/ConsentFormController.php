<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\ConsentForm;
use App\Models\Patient;
use App\Models\Appointment;
use App\Http\Requests\ConsentFormRequest;
use App\Services\ConsentFormService;
use App\DTO\ConsentFormDTO;
use Illuminate\Support\Facades\Storage;

class ConsentFormController extends Controller
{
    protected $service;

    public function __construct(ConsentFormService $service) {
        $this->service = $service;
    }

    public function storeConsent(ConsentFormRequest $request)
    {
        $form = $request->form_data;

        // data store mapping into patient table
        $patient = Patient::firstOrCreate(
            [
                'IC_No' => $form['no_ic'],
            ],
            [
                'patient_uuid' => Str::uuid(),
                'firstname' => $form['nama_pesakit'],
                'id_type' => "ic",
                'ic_no' => $form['no_ic'],
                'date_of_birth' => $form['tarikh_lahir'] ?? null,
                'address_line1' => $form['alamat1'] ?? null,
                'address_line2' => $form['alamat2'] ?? null,
                'postal_code' => $form['poskod'] ?? null,
                'city' => $form['bandar'] ?? null,
                'state' => $form['negeri'] ?? null,
                'country' => $form['negara'] ?? null,
                'contact_no' => $form['no_tel_bimbit'] ?? null,
                'sex' => $form['jantina'] === "LELAKI" ? "Male" : "Female",
                'emergency1_phone' => $form['no_tel_waris'] ?? null,
            ]
        );

        $dto = ConsentFormDTO::fromRequest($request);
        $consent = $this->service->create($dto);

        $appointment = Appointment::firstOrCreate(
            [
                'appointment_uuid' => Str::uuid(),
                'patient_uuid' => $patient->patient_uuid,
                'staff_uuid' => $form['staff_uuid'] ?? null,
                'consent_uuid' => $consent->consent_uuid ?? null,
                'patient_name' => $form['nama_pesakit'],
                'patient_ic_no' => $form['no_ic'],
                'appointment_datetime' => now()->format('Y-m-d H:i:s'),
                'status' => 'Booked',
                'reason' => 'Checkup',
                'patient_medical_problem' => $form['masalah_perubatan'] ?? null,
                'patient_disease_history' => $form['sejarah_penyakit'] ?? null
            ]
        );

        return response()->json([
            'message' => 'Success',
            'consent_uuid' => $consent->consent_uuid
        ]);
    }

    public function listByPatient(string $patient_uuid)
    {
        $patient = Patient::where('patient_uuid', $patient_uuid)->first();

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found',
            ], 404);
        }

        $patientIcNo = $patient->ic_no ?: $patient->getAttribute('IC_No');

        $query = ConsentForm::query();

        if ($patientIcNo) {
            $query->where('patient_ic_no', $patientIcNo);
        }

        $consents = $query
            ->orderByDesc('signed_at')
            ->orderByDesc('created_at')
            ->get()
            ->map(function (ConsentForm $consent) {
                return [
                    'consent_uuid' => $consent->consent_uuid,
                    'patient_name' => $consent->patient_name,
                    'patient_ic_no' => $consent->patient_ic_no,
                    'patient_dob' => $consent->patient_dob,
                    'patient_occupation' => $consent->patient_occupation,
                    'patient_status' => $consent->patient_status,
                    'patient_sex' => $consent->patient_sex,
                    'patient_address_line1' => $consent->patient_address_line1,
                    'patient_address_line2' => $consent->patient_address_line2,
                    'patient_address_postcode' => $consent->patient_address_postcode,
                    'patient_address_city' => $consent->patient_address_city,
                    'patient_address_state' => $consent->patient_address_state,
                    'patient_address_country' => $consent->patient_address_country,
                    'patient_contact_no' => $consent->patient_contact_no,
                    'patient_relative_contact_no' => $consent->patient_relative_contact_no,
                    'patient_home_contact_no' => $consent->patient_home_contact_no,
                    'patient_office_contact_no' => $consent->patient_office_contact_no,
                    'patient_medical_problem' => $consent->patient_medical_problem,
                    'patient_disease_history' => $consent->patient_disease_history,
                    'signature_path' => $consent->signature_path,
                    'signature_url' => $this->buildSignatureUrl($consent->signature_path),
                    'signed_at' => optional($consent->signed_at)->toISOString(),
                    'created_at' => optional($consent->created_at)->toISOString(),
                    'updated_at' => optional($consent->updated_at)->toISOString(),
                ];
            });

        return response()->json([
            'data' => $consents,
        ]);
    }

    public function showConsent(string $consent_uuid)
    {
        $consent = ConsentForm::where('consent_uuid', $consent_uuid)->first();

        if (!$consent) {
            return response()->json([
                'message' => 'Consent form not found',
            ], 404);
        }

        return response()->json([
            'data' => [
                'consent_uuid' => $consent->consent_uuid,
                'patient_name' => $consent->patient_name,
                'patient_ic_no' => $consent->patient_ic_no,
                'patient_dob' => $consent->patient_dob,
                'patient_occupation' => $consent->patient_occupation,
                'patient_status' => $consent->patient_status,
                'patient_sex' => $consent->patient_sex,
                'patient_address_line1' => $consent->patient_address_line1,
                'patient_address_line2' => $consent->patient_address_line2,
                'patient_address_postcode' => $consent->patient_address_postcode,
                'patient_address_city' => $consent->patient_address_city,
                'patient_address_state' => $consent->patient_address_state,
                'patient_address_country' => $consent->patient_address_country,
                'patient_contact_no' => $consent->patient_contact_no,
                'patient_relative_contact_no' => $consent->patient_relative_contact_no,
                'patient_home_contact_no' => $consent->patient_home_contact_no,
                'patient_office_contact_no' => $consent->patient_office_contact_no,
                'patient_medical_problem' => $consent->patient_medical_problem,
                'patient_disease_history' => $consent->patient_disease_history,
                'signature_path' => $consent->signature_path,
                'signature_url' => $this->buildSignatureUrl($consent->signature_path),
                'signature_data_url' => $this->buildSignatureDataUrl($consent->signature_path),
                'signed_at' => optional($consent->signed_at)->toISOString(),
                'created_at' => optional($consent->created_at)->toISOString(),
                'updated_at' => optional($consent->updated_at)->toISOString(),
            ],
        ]);
    }

    private function buildSignatureUrl(?string $signaturePath): ?string
    {
        if (!$signaturePath) {
            return null;
        }

        return url(Storage::disk('public')->url($signaturePath));
    }

    private function buildSignatureDataUrl(?string $signaturePath): ?string
    {
        if (!$signaturePath || !Storage::disk('public')->exists($signaturePath)) {
            return null;
        }

        $mimeType = Storage::disk('public')->mimeType($signaturePath) ?: 'image/png';
        $binaryContent = Storage::disk('public')->get($signaturePath);

        if (!$binaryContent) {
            return null;
        }

        return 'data:' . $mimeType . ';base64,' . base64_encode($binaryContent);
    }
}
