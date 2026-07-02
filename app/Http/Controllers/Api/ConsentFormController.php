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
            'id' => $consent->id
        ]);
    }
}
