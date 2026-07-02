<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\StockService;


class StockController extends Controller
{
    public function __construct(
        protected StockService $service
    ) {}

    public function stockIn(Request $request)
    {
        return $this->service->stockIn($request->all());
    }

    public function stockOut(Request $request)
    {
        return $this->service->stockOut($request->all());
    }

    public function adjustment(Request $request)
    {
        return $this->service->adjustment($request->all());
    }

    public function history(string $productId)
    {
        return $this->service->history($productId);
    }
}
