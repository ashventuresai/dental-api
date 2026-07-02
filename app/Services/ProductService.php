<?php

namespace App\Services;

use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\UpdateProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Str;
use App\Services\AutoNumberService;

class ProductService
{
    protected $repository;
    protected $autoNumberService;

    public function __construct(ProductRepositoryInterface $repository, AutoNumberService $autoNumberService) {
        $this->repository = $repository;
        $this->autoNumberService = $autoNumberService;
    }

    public function getAll(array $filters = [])
    {
        return $this->repository->all($filters);
    }

    public function getById(string $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        $data['product_uuid'] = Str::uuid();
        $data['product_code'] = $this->autoNumberService->generate('PRODUCT');
        $dto = CreateProductDTO::fromArray($data);

        return $this->repository->create($dto);
    }

    public function update(string $id, array $data)
    {
        $dto = UpdateProductDTO::fromArray($data);

        return $this->repository->update($id, $dto);
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    private function generateCode(): string
    {
        return 'PRD-' . strtoupper(Str::random(6));
    }
}
