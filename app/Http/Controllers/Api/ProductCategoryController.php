<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function options(Request $request)
    {
        $categories = ProductCategory::all();

        return response()->json([
            'data' => $categories,
        ]);
    }
}
