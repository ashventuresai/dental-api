<?php

namespace App\Repositories;

use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Product::query()->with(['category', 'unit']);

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);

            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('product_code', 'like', '%' . $search . '%')
                    ->orWhere('barcode', 'like', '%' . $search . '%')
                    ->orWhere('generic_name', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%');
            });
        }

        if (!empty($filters['product_category_uuid'])) {
            $query->where('product_category_uuid', $filters['product_category_uuid']);
        }

        if (!empty($filters['product_unit_uuid'])) {
            $query->where('product_unit_uuid', $filters['product_unit_uuid']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (array_key_exists('is_active', $filters) && $filters['is_active'] !== null && $filters['is_active'] !== '') {
            $query->where('is_active', filter_var($filters['is_active'], FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE) ?? $filters['is_active']);
        }

        $perPage = (int) ($filters['per_page'] ?? 10);
        $perPage = max(1, min($perPage, 100));

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(string $id): ?Product
    {
        return Product::with(['category', 'unit'])
            ->where('id', $id)
            ->orWhere('product_uuid', $id)
            ->firstOrFail();
    }

    public function create(CreateProductDTO $dto): Product
    {
        return Product::create($dto->toArray())->fresh(['category', 'unit']);
    }

    public function update(string $id, UpdateProductDTO $dto): Product
    {
        $product = $this->find($id);
        $product->update($dto->toArray());

        return $product->fresh(['category', 'unit']);
    }

    public function delete(string $id): bool
    {
        return $this->find($id)->delete();
    }
}
