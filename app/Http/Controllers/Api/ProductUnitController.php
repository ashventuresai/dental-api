<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductUnit;
use Illuminate\Http\Request;

class ProductUnitController extends Controller
{
    public function options()
    {
        // $includeInactive = $request->boolean('include_inactive', false);

        // $query = ProductUnit::query()
        //     ->whereNotNull('product_unit_uuid')
        //     ->orderBy('name');

        // if (!$includeInactive) {
        //     $query->where('is_active', true);
        // }

        // $units = $query
        //     ->get(['id', 'product_unit_uuid', 'name', 'description', 'is_active'])
        //     ->map(function (ProductUnit $unit) {
        //         return [
        //             'id' => $unit->id,
        //             'product_unit_uuid' => $unit->product_unit_uuid,
        //             'name' => $unit->name,
        //             'description' => $unit->description,
        //             'is_active' => (bool) $unit->is_active,
        //         ];
        //     })
        //     ->values();

        $units = ProductUnit::all();

        return response()->json([
            'data' => $units,
        ]);
    }
}
