<?php

namespace App\DTO\Payment;

class CreatePaymentDTO
{
    public function __construct(
        public string $invoice_uuid,
        public float $amount,
        public string $method,
        public ?string $reference_no
    ) {}

    public static function fromCreateRequest($request): self
    {
        return new self(
            $request->invoice_uuid,
            $request->amount,
            $request->method,
            $request->reference_no
        );
    }
}
