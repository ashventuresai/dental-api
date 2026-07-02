<?php

namespace App\Services;

use App\Models\Product;
use App\DTO\StockCreateDTO;
use App\DTO\StockUpdateDTO;
use App\Repositories\StockRepository;
use App\Interfaces\StockRepositoryInterface;

class StockService
{
    protected $repository;

    public function __construct(StockRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function stockIn(array $data)
    {
        $data['type'] = 'in';
        return $this->repository->create(StockCreateDTO::fromCreateArray($data));
    }

    public function stockOut(array $data)
    {
        $data['type'] = 'out';
        return $this->repository->create(StockCreateDTO::fromCreateArray($data));
    }

    public function adjustment(array $data)
    {
        $data['type'] = 'adjustment';
        return $this->repository->update(StockUpdateDTO::fromUpdateArray($data));
    }

    public function history(string $productId)
    {
        return $this->repository->history($productId);
    }

    public function useForAppointment(array $items, string $appointmentId)
    {
        foreach ($items as $item) {

            $product = Product::findOrFail($item['product_uuid']);

            $quantity = $item['quantity'];

            if ($product->current_stock < $quantity) {
                throw new \Exception("Insufficient stock for {$product->name}");
            }

            app(StockRepository::class)->create(
                StockCreateDTO::fromCreateArray([
                    'product_uuid' => $product->id,
                    'type' => 'out',
                    'reference_type' => 'appointment',
                    'reference_id' => $appointmentId,
                    'quantity' => $quantity,
                    'remarks' => 'Used in appointment',
                    'performed_by' => auth()->id(),
                ])
            );
        }
    }
}
