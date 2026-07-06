<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\AppointmentService;
use App\DTO\Appointment\CreateAppointmentDTO;
use App\DTO\Appointment\UpdateAppointmentDTO;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;
use App\Models\AppointmentTreatmentProduct;

class AppointmentController extends Controller
{
    public function __construct(
        protected AppointmentService $service
    ) {}

    public function index()
    {
        return $this->service->list();
    }

    public function store(AppointmentRequest $request)
    {
        $dto = CreateAppointmentDTO::fromCreateRequest($request);
        return $this->service->create($dto);
    }

    public function checkIn($id)
    {
        return $this->service->checkIn($id);
    }

    public function startTreatment($id)
    {
        return $this->service->startTreatment($id);
    }

    public function markWaitingPayment($id)
    {
        return $this->service->markWaitingPayment($id);
    }

    public function complete($id)
    {
        return $this->service->complete($id);
    }

    public function show($appointment_uuid)
    {
        return $this->service->getByUuid($appointment_uuid);
    }

    public function historyForPatient($patient_uuid)
    {
        return $this->service->getByPatientUuid($patient_uuid);
    }

    public function cancel($id)
    {
        return $this->service->cancel($id);
    }

    public function update(AppointmentRequest $request, $id)
    {
        $dto = UpdateAppointmentDTO::fromUpdateRequest($request);
        return $this->service->update($id, $dto);
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }

    public function addProducts(Request $request, $appointmentId)
    {
        // $request->validate([
        //     'products' => ['required', 'array'],
        //     'products.*.product_uuid' => ['required', 'uuid'],
        //     'products.*.quantity' => ['required', 'integer', 'min:1'],
        // ]);

        // app(AppointmentService::class)->attachProducts($appointmentId, $request->products);

        // return response()->json([
        //     'message' => 'Products added & stock updated successfully'
        // ]);
    }
}
