<?php

namespace App\DTO\Product;

use App\Enums\ProductType;

class CreateProductDTO
{
    public function __construct(
        public readonly string $product_uuid,
        public readonly string $product_code,
        public readonly ?string $barcode,
        public readonly string $name,
        public readonly ?string $generic_name,
        public readonly string $product_category_uuid,
        public readonly string $product_unit_uuid,
        public readonly ?string $brand,
        // public readonly ProductType $type,
        public readonly float $purchase_price,
        public readonly float $selling_price,
        public readonly int $minimum_stock,
        public readonly int $current_stock,
        public readonly ?string $description,
        public readonly bool $is_active = true,
        public readonly ?string $appointment_uuid
    ) {}

    public static function fromCreateRequest(array $data): self
    {
        return new self(
            product_uuid: $data['product_uuid'] ?? '',
            product_code: $data['product_code'] ?? '',
            barcode: $data['barcode'] ?? null,
            name: $data['name'],
            generic_name: $data['generic_name'] ?? null,
            product_category_uuid: $data['product_category_uuid'],
            product_unit_uuid: $data['product_unit_uuid'],
            brand: $data['brand'] ?? null,
            // type: $data['type'] instanceof ProductType ? $data['type'] : ProductType::from($data['type']),
            purchase_price: (float) $data['purchase_price'],
            selling_price: (float) $data['selling_price'],
            minimum_stock: (int) $data['minimum_stock'],
            current_stock: array_key_exists('current_stock', $data) && $data['current_stock'] !== null
                ? (int) $data['current_stock']
                : 0,
            description: $data['description'] ?? null,
            is_active: $data['is_active'] ?? true,
            appointment_uuid: $data['appointment_uuid'] ?? null
        );
    }

    public static function fromArray(array $data): self
    {
        return self::fromCreateRequest($data);
    }

    public function toArray(): array
    {
        return [
            'product_uuid' => $this->product_uuid,
            'product_code' => $this->product_code,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'generic_name' => $this->generic_name,
            'product_category_uuid' => $this->product_category_uuid,
            'product_unit_uuid' => $this->product_unit_uuid,
            'brand' => $this->brand,
            'purchase_price' => $this->purchase_price,
            'selling_price' => $this->selling_price,
            'minimum_stock' => $this->minimum_stock,
            'current_stock' => $this->current_stock,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'appointment_uuid' => $this->appointment_uuid,
        ];
    }

    public function toUpdateArray(): array
    {
        return $this->toArray();
    }
}
