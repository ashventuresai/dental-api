<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductCategory;
use App\Models\ProductUnit;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $products = [
            [
                'name' => 'Amoxicillin 500mg',
                'generic_name' => 'Amoxicillin',
                'category' => 'Medicine',
                'unit' => 'Tablet',
                'purchase_price' => 10.00,
                'selling_price' => 15.00,
                'minimum_stock' => 50,
                'current_stock' => 200,
            ],
            [
                'name' => 'Paracetamol 500mg',
                'generic_name' => 'Paracetamol',
                'category' => 'Medicine',
                'unit' => 'Tablet',
                'purchase_price' => 5.00,
                'selling_price' => 10.00,
                'minimum_stock' => 100,
                'current_stock' => 500,
            ],
            [
                'name' => 'Composite Resin A2',
                'generic_name' => null,
                'category' => 'Dental Material',
                'unit' => 'Cartridge',
                'purchase_price' => 80.00,
                'selling_price' => 120.00,
                'minimum_stock' => 10,
                'current_stock' => 25,
            ],
            [
                'name' => 'Cotton Roll',
                'generic_name' => null,
                'category' => 'Consumable',
                'unit' => 'Pack',
                'purchase_price' => 3.00,
                'selling_price' => 6.00,
                'minimum_stock' => 200,
                'current_stock' => 1000,
            ],
            [
                'name' => 'Dental Mirror',
                'generic_name' => null,
                'category' => 'Equipment',
                'unit' => 'Piece',
                'purchase_price' => 25.00,
                'selling_price' => 40.00,
                'minimum_stock' => 5,
                'current_stock' => 20,
            ],
        ];

        foreach ($products as $index => $p) {

            $category = ProductCategory::where('name', $p['category'])->first();
            $unit = ProductUnit::where('name', $p['unit'])->first();

            Product::create([
                'product_uuid' => Str::uuid(),
                'product_code' => 'PRD-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'barcode' => null,
                'name' => $p['name'],
                'generic_name' => $p['generic_name'],
                'product_category_uuid' => $category->product_category_uuid,
                'product_unit_uuid' => $unit->product_unit_uuid,
                'brand' => 'Clinic Standard',
                'purchase_price' => $p['purchase_price'],
                'selling_price' => $p['selling_price'],
                'minimum_stock' => $p['minimum_stock'],
                'current_stock' => $p['current_stock'],
                'description' => $p['name'] . ' for dental treatment',
                'is_active' => true,
            ]);
        }
    }
}
