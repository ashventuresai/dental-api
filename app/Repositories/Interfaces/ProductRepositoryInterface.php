<?php

namespace App\Repositories\Interfaces;

use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function all(array $filters = []);
    public function find(string $id): ?Product;
    public function create(CreateProductDTO $dto): Product;
    public function update(string $id, UpdateProductDTO $dto): Product;
    public function delete(string $id): bool;
}
