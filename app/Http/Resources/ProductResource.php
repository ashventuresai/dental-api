<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_uuid' => $this->product_uuid,
            'product_code' => $this->product_code,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'generic_name' => $this->generic_name,
            'brand' => $this->brand,
            'purchase_price' => $this->purchase_price,
            'selling_price' => $this->selling_price,
            'minimum_stock' => $this->minimum_stock,
            'current_stock' => $this->current_stock,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'stock_status' => $this->stock_status,
            'is_low_stock' => $this->is_low_stock,
            'product_category_uuid' => $this->product_category_uuid,
            'product_unit_uuid' => $this->product_unit_uuid,
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category?->id,
                    'product_category_uuid' => $this->category?->product_category_uuid,
                    'name' => $this->category?->name,
                    'description' => $this->category?->description,
                    'is_active' => $this->category?->is_active,
                ];
            }),
            'unit' => $this->whenLoaded('unit', function () {
                return [
                    'id' => $this->unit?->id,
                    'product_unit_uuid' => $this->unit?->product_unit_uuid,
                    'name' => $this->unit?->name,
                    'is_active' => $this->unit?->is_active,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
