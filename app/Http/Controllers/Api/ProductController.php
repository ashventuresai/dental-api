<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Services\AutoNumberService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    public function index(Request $request)
    {
        $products = $this->service->getAll($request->all());

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->service->create($request->validated());

        return new ProductResource($product);
    }

    public function show(string $id)
    {
        $product = $this->service->getById($id);

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = $this->service->update($id, $request->validated());

        return new ProductResource($product);
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
