<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Payment::with(['invoice.appointment']);

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);

            $query->where(function ($builder) use ($search) {
                $builder->where('payment_uuid', 'like', '%' . $search . '%')
                    ->orWhere('invoice_uuid', 'like', '%' . $search . '%')
                    ->orWhere('method', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        if (!empty($filters['invoice_uuid'])) {
            $query->where('invoice_uuid', $filters['invoice_uuid']);
        }

        if (!empty($filters['method'])) {
            $query->where('method', $filters['method']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $perPage = (int) ($filters['per_page'] ?? 10);
        $perPage = max(1, min($perPage, 100));

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }

    public function findByUuid(string $paymentUuid)
    {
        return Payment::with(['invoice.appointment', 'invoice.items'])
            ->where('payment_uuid', $paymentUuid)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function getTotalPaid(string $invoiceUuid)
    {
        return (float) Payment::where('invoice_uuid', $invoiceUuid)->sum('amount');
    }
}
