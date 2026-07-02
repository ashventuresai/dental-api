<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Medicine',
            'Dental Material',
            'Consumable',
            'Equipment',
            'Service',
        ];

        foreach ($categories as $category) {
            ProductCategory::create([
                'product_category_uuid' => Str::uuid(),
                'name' => $category,
                'description' => $category . ' items',
                'is_active' => true,
            ]);
        }
    }
}
