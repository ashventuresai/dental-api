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
            ['name' => 'Box', 'description' => 'Box of items'],
            ['name' => 'Bottle', 'description' => 'Bottle of liquid'],
            ['name' => 'Piece', 'description' => 'Single item'],
            ['name' => 'Pack', 'description' => 'Pack of items'],
            ['name' => 'Sachet', 'description' => 'Small sealed packet'],
            ['name' => 'Tablet', 'description' => 'Tablet form'],
            ['name' => 'Capsule', 'description' => 'Capsule form'],
            ['name' => 'Cartridge', 'description' => 'Cartridge form'],
        ];

        foreach ($units as $unit) {
            ProductUnit::create([
                'product_unit_uuid' => Str::uuid(),
                'name' => $unit['name'],
                'is_active' => true,
            ]);
        }
    }
}
