<?php

namespace App\Services;

use App\DTO\Invoice\CreateInvoiceDTO;
use App\Models\Appointment;
use App\Models\Treatment;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class InvoiceService
{
    public function __construct(protected InvoiceRepositoryInterface $invoiceRepo)
    {
    }

    public function list(array $filters = [])
    {
        return $this->invoiceRepo->all($filters);
    }

    public function getByUuid(string $invoiceUuid)
    {
        return $this->invoiceRepo->findByUuid($invoiceUuid);
    }

    public function create(CreateInvoiceDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $updateTreatmentStatus = Treatment::where('treatment_uuid', $dto->treatment_uuid)->firstOrFail();
            $updateTreatmentStatus->update([
                'status' => 'Completed',
            ]);

            $updateAppointmentStatus = Appointment::where('appointment_uuid', $dto->appointment_uuid)->firstOrFail();
            $updateAppointmentStatus->update([
                'status' => 'Pending Payment',
            ]);

            $appointment = Appointment::with('invoice')->where('appointment_uuid', $dto->appointment_uuid)->firstOrFail();

            if ($appointment->patient_uuid !== $dto->patient_uuid) {
                throw ValidationException::withMessages([
                    'patient_uuid' => ['The selected patient does not match the appointment.'],
                ]);
            }

            if ($appointment->invoice) {
                return $this->invoiceRepo->findByUuid($appointment->invoice->invoice_uuid);
            }

            $subtotal = collect($dto->items)->sum(
                fn (array $item) => (float) $item['quantity'] * (float) $item['unit_price']
            );

            $discount = min((float) $dto->discount, $subtotal);
            $total = max($subtotal - $discount, 0);

            $invoice = $this->invoiceRepo->create([
                'invoice_uuid' => (string) Str::uuid(),
                'appointment_uuid' => $dto->appointment_uuid,
                'patient_uuid' => $dto->patient_uuid,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'status' => 'unpaid',
                'issued_at' => now(),
            ]);

            $this->invoiceRepo->addItems($invoice->invoice_uuid, $dto->appointment_uuid, $dto->items);

            return $this->invoiceRepo->findByUuid($invoice->invoice_uuid);
        });
    }
}
