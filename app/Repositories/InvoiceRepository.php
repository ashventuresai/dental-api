<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Invoice::with(['appointment', 'patient', 'items', 'payments']);

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);

            $query->where(function ($builder) use ($search) {
                $builder->where('invoice_uuid', 'like', '%' . $search . '%')
                    ->orWhere('appointment_uuid', 'like', '%' . $search . '%')
                    ->orWhere('patient_uuid', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        if (!empty($filters['appointment_uuid'])) {
            $query->where('appointment_uuid', $filters['appointment_uuid']);
        }

        if (!empty($filters['patient_uuid'])) {
            $query->where('patient_uuid', $filters['patient_uuid']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $perPage = (int) ($filters['per_page'] ?? 10);
        $perPage = max(1, min($perPage, 100));

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }

    public function findByUuid(string $invoiceUuid)
    {
        return Invoice::with(['appointment', 'patient', 'items', 'payments'])
            ->where('invoice_uuid', $invoiceUuid)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return Invoice::create($data);
    }

    public function addItems(string $invoiceUuid, string $appointmentUuid, array $items): void
    {
        $rows = [];

        foreach ($items as $item) {
            $quantity = (int) $item['quantity'];
            $unitPrice = (float) $item['unit_price'];

            $rows[] = [
                'invoice_uuid' => $invoiceUuid,
                'appointment_uuid' => $appointmentUuid,
                'item_type' => $item['item_type'] ?? 'procedure',
                'description' => $item['description'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $quantity * $unitPrice,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if ($rows !== []) {
            InvoiceItem::insert($rows);
        }
    }
}
