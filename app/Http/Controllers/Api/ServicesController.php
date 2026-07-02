<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ServicesRequest;
use App\DTO\Services\CreateServicesDTO;
use App\DTO\Services\UpdateServicesDTO;
use App\Services\ServicesService;
use App\Services\AutoNumberService;

class ServicesController extends Controller
{
    protected $servicesService;
    protected $autoNumberService;

    public function __construct(ServicesService $servicesService, AutoNumberService $autoNumberService){
        $this->servicesService = $servicesService;
        $this->autoNumberService = $autoNumberService;
    }

    public function index(Request $request)
    {
        return response()->json(
            $this->servicesService->getAll($request->search)
        );
    }

    public function show($uuid)
    {
        return response()->json(
            $this->servicesService->findByUUID($uuid)
        );
    }

    public function store(ServicesRequest $request)
    {
        $serviceRunningNo = $this->autoNumberService->generate('SERVICE');
        $dto = CreateServicesDTO::fromCreateRequest($request, $serviceRunningNo);

        return response()->json(
            $this->servicesService->create($dto)
        );
    }

    public function update(ServicesRequest $request, $uuid)
    {
        $dto = UpdateServicesDTO::fromUpdateRequest($request);

        return response()->json(
            $this->servicesService->update($uuid, $dto)
        );
    }

    public function destroy($uuid)
    {
        return response()->json(
            $this->servicesService->delete($uuid)
        );
    }
}
