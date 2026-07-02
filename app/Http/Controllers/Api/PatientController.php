<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DTO\Patient\CreatePatientDTO;
use App\DTO\Patient\UpdatePatientDTO;
use App\Services\PatientService;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    protected $service;

    public function __construct(PatientService $service){
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json(
            $this->service->getAllPatients($request->all())
        );
    }

    public function store(PatientRequest $request){

        $dto = CreatePatientDTO::fromCreateRequest($request);

        $patient = $this->service->createPatient(
            $dto->toArray()
        );

        return response()->json($patient);
    }

    public function update(PatientRequest $request, $patient_uuid){
        $dto = UpdatePatientDTO::fromUpdateRequest($request);

        return response()->json(
            $this->service->updatePatient($patient_uuid, $dto->toArray())
        );
    }

    public function destroy($patient_uuid)
    {
        $this->service->deletePatient($patient_uuid);

        return response()->json(['message' => 'Deleted']);
    }
}
