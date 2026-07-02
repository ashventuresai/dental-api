<?php

namespace App\DTO\Invoice;

class CreateInvoiceDTO
{
    public function __construct(
        public string $appointment_uuid,
        public string $patient_uuid,
        public ?string $treatment_uuid,
        public array $items,
        public float $discount = 0
    ) {}

    public static function fromCreateRequest($request): self
    {
        return new self(
            $request->appointment_uuid,
            $request->patient_uuid,
            $request->treatment_uuid,
            $request->items,
            $request->discount ?? 0
        );
    }
}
