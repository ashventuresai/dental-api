<?php

namespace App\Services;

use App\DTO\Payment\CreatePaymentDTO;
use App\Models\Invoice;
use App\Models\Appointment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentService
{
    public function __construct(protected PaymentRepositoryInterface $paymentRepo)
    {
    }

    public function list(array $filters = [])
    {
        return $this->paymentRepo->all($filters);
    }

    public function getByUuid(string $paymentUuid)
    {
        return $this->paymentRepo->findByUuid($paymentUuid);
    }

    public function pay(CreatePaymentDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $invoice = Invoice::where('invoice_uuid', $dto->invoice_uuid)->lockForUpdate()->firstOrFail();
            $paidAmount = $this->paymentRepo->getTotalPaid($invoice->invoice_uuid);
            $outstanding = max((float) $invoice->total - $paidAmount, 0);

            if ($outstanding <= 0) {
                throw ValidationException::withMessages([
                    'invoice_uuid' => ['The invoice is already fully paid.'],
                ]);
            }

            if ((float) $dto->amount > $outstanding) {
                throw ValidationException::withMessages([
                    'amount' => ['The payment amount exceeds the outstanding balance.'],
                ]);
            }

            $payment = $this->paymentRepo->create([
                'payment_uuid' => (string) Str::uuid(),
                'invoice_uuid' => $invoice->invoice_uuid,
                'amount' => $dto->amount,
                'method' => $dto->method,
                'status' => 'success',
                'reference_no' => $dto->reference_no,
                'paid_at' => now(),
            ]);

            $totalPaid = $paidAmount + (float) $dto->amount;
            $invoice->status = $totalPaid >= (float) $invoice->total ? 'paid' : 'partially_paid';
            $invoice->save();

            if($invoice->status === 'paid') {
                $updateAppointmentStatus = Appointment::where('appointment_uuid', $invoice->appointment_uuid)->firstOrFail();
                $updateAppointmentStatus->update([
                    'status' => 'Completed',
                ]);
            }

            return $this->paymentRepo->findByUuid($payment->payment_uuid);
        });
    }
}
