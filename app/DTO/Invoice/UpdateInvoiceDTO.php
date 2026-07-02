<?php

namespace App\DTO\Invoice;

class UpdateInvoiceDTO
{
    public function __construct(
        public string $appointment_uuid,
        public string $patient_uuid,
        public array $items,
        public float $discount = 0
    ) {}

    public static function fromUpdateRequest($request): self
    {
        return new self(
            $request->appointment_uuid,
            $request->patient_uuid,
            $request->items,
            $request->discount ?? 0
        );
    }
}
