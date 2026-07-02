<?php

namespace App\DTO\Stock;

use App\Enums\StockMovementType;
use App\Enums\StockReferenceType;

class CreateStockDTO
{
    public function __construct(
        public readonly string $product_uuid,
        public readonly StockMovementType $type,
        public readonly StockReferenceType $reference_type,
        public readonly ?string $reference_id,
        public readonly int $quantity,
        public readonly ?string $remarks = null,
        public readonly ?int $performed_by = null,
    ) {}

    public static function fromCreateArray(array $data): self
    {
        return new self(
            product_uuid: $data['product_uuid'],
            type: StockMovementType::from($data['type']),
            reference_type: StockReferenceType::from($data['reference_type']),
            reference_id: $data['reference_id'] ?? null,
            quantity: (int) $data['quantity'],
            remarks: $data['remarks'] ?? null,
            performed_by: $data['performed_by'] ?? null,
        );
    }
}
