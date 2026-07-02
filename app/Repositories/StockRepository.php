<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use App\DTO\StockDTO;
use App\DTO\StockCreateDTO;
use App\DTO\Stock\CreateStockDTO;
use App\DTO\Stock\UpdateStockDTO;
use App\Repositories\Interfaces\StockRepositoryInterface;

class StockRepository implements StockRepositoryInterface
{
     public function create(StockDTO $dto)
    {
        return DB::transaction(function () use ($dto) {

            $product = Product::findOrFail($dto->product_uuid);

            // calculate new stock
            $current = $product->current_stock;

            $newStock = match ($dto->type->value) {
                'in' => $current + $dto->quantity,
                'out' => $current - $dto->quantity,
                'adjustment' => $dto->quantity,
                default => $current,
            };

            // prevent negative stock
            if ($newStock < 0) {
                throw new \Exception("Stock cannot be negative");
            }

            // update product stock
            $product->update([
                'current_stock' => $newStock
            ]);

            // create movement
            return StockMovement::create([
                'product_uuid' => $dto->product_uuid,
                'type' => $dto->type,
                'reference_type' => $dto->reference_type,
                'reference_id' => $dto->reference_id,
                'quantity' => $dto->quantity,
                'balance_after' => $newStock,
                'remarks' => $dto->remarks,
                'performed_by' => $dto->performed_by,
            ]);
        });
    }

    public function update(UpdateStockDTO $dto)
    {
        return DB::transaction(function () use ($dto) {

            $product = Product::findOrFail($dto->product_uuid);

            // calculate new stock
            $current = $product->current_stock;

            $newStock = match ($dto->type->value) {
                'in' => $current + $dto->quantity,
                'out' => $current - $dto->quantity,
                'adjustment' => $dto->quantity,
                default => $current,
            };

            // prevent negative stock
            if ($newStock < 0) {
                throw new \Exception("Stock cannot be negative");
            }

            // update product stock
            $product->update([
                'current_stock' => $newStock
            ]);

            // create movement
            return StockMovement::create([
                'product_uuid' => $dto->product_uuid,
                'type' => $dto->type,
                'reference_type' => $dto->reference_type,
                'reference_id' => $dto->reference_id,
                'quantity' => $dto->quantity,
                'balance_after' => $newStock,
                'remarks' => $dto->remarks,
                'performed_by' => $dto->performed_by,
            ]);
        });
    }

    public function history(string $productId)
    {
        return StockMovement::where('product_uuid', $productId)
            ->latest()
            ->paginate(10);
    }
}
