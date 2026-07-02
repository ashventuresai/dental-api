<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreatmentRequest;
use App\Services\TreatmentService;
use App\DTO\Treatment\CreateTreatmentDTO;
use App\DTO\Treatment\UpdateTreatmentDTO;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function __construct(
        protected TreatmentService $service
    ) {}

    public function store(TreatmentRequest $request)
    {
        $dto = CreateTreatmentDTO::fromCreateRequest($request->validated());

        $treatment = $this->service->create($dto);

        return response()->json([
            'message' => 'Treatment created successfully',
            'data' => $treatment
        ], 201);
    }

    public function update(TreatmentRequest $request, $uuid)
    {
        $dto = UpdateTreatmentDTO::fromUpdateRequest($request->validated());

        $treatment = $this->service->update($uuid, $dto);

        return response()->json([
            'message' => 'Treatment updated successfully',
            'data' => $treatment
        ]);
    }

    public function show($uuid)
    {
        $treatment = $this->service->getByUuid($uuid);

        return response()->json([
            'data' => $treatment
        ]);
    }


}
