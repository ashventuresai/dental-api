<?php

namespace App\Repositories\Interfaces;

use App\DTO\StockCreateDTO;

interface StockRepositoryInterface
{
    public function create(CreateStockDTO $dto);
    public function update(UpdateStockDTO $dto);
    public function history(string $productId);
}
