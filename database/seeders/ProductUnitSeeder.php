<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductUnit;
use Illuminate\Support\Str;

class ProductUnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['name' => 'Kilogram', 'description' => 'Kg'],
            ['name' => 'Litre', 'description' => 'L'],
            ['name' => 'Gram', 'description' => 'g'],
            ['name' => 'Milligram', 'description' => 'mg'],
            ['name' => 'Millilitre', 'description' => 'ml'],
            ['name' => 'Inch', 'description' => 'in'],
            ['name' => 'Centimeter', 'description' => 'cm'],
            ['name' => 'Meter', 'description' => 'm'],
            ['name' => 'Box', 'description' => 'Box'],
            ['name' => 'Bottle', 'description' => 'Bottle'],
            ['name' => 'Piece', 'description' => 'Pcs'],
            ['name' => 'Pack', 'description' => 'Pack'],
            ['name' => 'Sachet', 'description' => 'Sachet'],
            ['name' => 'Tablet', 'description' => 'Tablet']
        ];

        foreach ($units as $unit) {
            ProductUnit::create([
                'product_unit_uuid' => Str::uuid(),
                'name' => $unit['name'],
                'description' => $unit['description'],
                'is_active' => true,
            ]);
        }
    }
}
