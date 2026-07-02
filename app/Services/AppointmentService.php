<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\AppointmentTreatmentProduct;
use App\Services\StockService;
use App\Enums\AppointmentStatus;
use App\DTO\Appointment\CreateAppointmentDTO;
use App\DTO\Appointment\UpdateAppointmentDTO;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;

class AppointmentService
{
    protected $appointmentRepo;

    public function __construct(AppointmentRepositoryInterface $appointmentRepo)
    {
        $this->appointmentRepo = $appointmentRepo;
    }
    public function list()
    {
        return $this->appointmentRepo->getAll();
    }

    public function getByUuid($appointment_uuid)
    {
        return $this->appointmentRepo->findByUuid($appointment_uuid);
    }

    public function create(CreateAppointmentDTO $dto)
    {
        // BUSINESS RULE EXAMPLE:
        // prevent double booking logic can go here

        return $this->appointmentRepo->create($dto);
    }

    public function checkIn($id)
    {
        return $this->appointmentRepo->updateStatus($id, AppointmentStatus::PATIENT_WAITING->value);
    }

    public function startTreatment($id)
    {
        return $this->appointmentRepo->updateStatus($id, AppointmentStatus::IN_TREATMENT->value);
    }

    public function markWaitingPayment($id)
    {
        return $this->appointmentRepo->updateStatus($id, AppointmentStatus::PENDING_PAYMENT->value);
    }

    public function complete($id)
    {
        return $this->appointmentRepo->updateStatus($id, AppointmentStatus::COMPLETED->value);
    }

    public function update($id, UpdateAppointmentDTO $dto)
    {
        return $this->appointmentRepo->update($id, $dto);
    }

    public function cancel($id)
    {
        return $this->appointmentRepo->updateStatus($id, AppointmentStatus::CANCELLED->value);
    }

    public function delete($id)
    {
        return $this->appointmentRepo->delete($id);
    }

    public function attachProducts(string $appointmentId, array $products)
    {
        return DB::transaction(function () use ($appointmentId, $products) {

            foreach ($products as $item) {

                $product = Product::where('product_uuid', $item['product_uuid'])->firstOrFail();

                // 1. Save usage record
                AppointmentTreatmentProduct::create([
                    'appointment_uuid' => $appointmentId,
                    'product_uuid' => $product->product_uuid,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->selling_price,
                    'total_price' => $product->selling_price * $item['quantity'],
                ]);

                // 2. Deduct stock automatically
                app(StockService::class)->useForAppointment([
                    [
                        'product_uuid' => $product->product_uuid,
                        'quantity' => $item['quantity']
                    ]
                ], $appointmentId);
            }
        });
    }

    public function rollbackProducts(string $appointmentId)
    {
        return DB::transaction(function () use ($appointmentId) {

            $items = AppointmentTreatmentProduct::where('appointment_uuid', $appointmentId)->get();

            foreach ($items as $item) {

                $product = Product::where('product_uuid', $item->product_uuid)->firstOrFail();

                // return stock
                app(StockService::class)->stockIn([
                    'product_uuid' => $product->product_uuid,
                    'quantity' => $item->quantity,
                    'reference_type' => 'appointment',
                    'reference_id' => $appointmentId,
                    'remarks' => 'Rollback from appointment',
                    'performed_by' => auth()->id(),
                ]);

                $item->delete();
            }
        });
    }
}
