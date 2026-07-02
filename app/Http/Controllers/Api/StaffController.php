<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StaffRequest;
use App\Services\StaffService;
use App\DTO\Staff\CreateStaffDTO;
use App\DTO\Staff\UpdateStaffDTO;
use App\Services\AutoNumberService;

class StaffController extends Controller
{
    protected $staffService;
    protected $autoNumberService;

    public function __construct(
        StaffService $staffService,
        AutoNumberService $autoNumberService
    ){
        $this->staffService = $staffService;
        $this->autoNumberService = $autoNumberService;

    }


    public function index(Request $request)
    {
        return response()->json(
            $this->staffService->getAll($request->search)
        );
    }

    public function show($uuid)
    {
        return response()->json(
            $this->staffService->findByUUID($uuid)
        );
    }

    public function store(StaffRequest $request)
    {
        $staffIdRunningNo = $this->autoNumberService->generate('STAFF');
        $dto = CreateStaffDTO::fromCreateRequest($request, $staffIdRunningNo);

        return response()->json(
            $this->staffService->create($dto)
        );
    }

    public function update(StaffRequest $request, $uuid)
    {
        $dto = UpdateStaffDTO::fromUpdateRequest($request);

        return response()->json(
            $this->staffService->update($uuid, $dto)
        );
    }

    public function destroy($uuid)
    {
        return response()->json(
            $this->staffService->delete($uuid)
        );
    }
}
