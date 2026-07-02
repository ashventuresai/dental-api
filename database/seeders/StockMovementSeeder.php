<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Str;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {

            // 1. Initial stock in (purchase)
            StockMovement::create([
                'stock_movement_uuid' => Str::uuid(),
                'product_uuid' => $product->product_uuid,
                'type' => 'in',
                'reference_type' => 'purchase',
                'reference_id' => Str::uuid(),
                'quantity' => $product->current_stock,
                'balance_after' => $product->current_stock,
                'remarks' => 'Initial stock seeder',
                'performed_by' => 1,
            ]);

            // 2. Simulated usage (appointment usage)
            $usedQty = rand(1, 10);

            $newBalance = $product->current_stock - $usedQty;

            if ($newBalance < 0) {
                $newBalance = 0;
            }

            StockMovement::create([
                'stock_movement_uuid' => Str::uuid(),
                'product_uuid' => $product->product_uuid,
                'type' => 'out',
                'reference_type' => 'appointment',
                'reference_id' => Str::uuid(),
                'quantity' => $usedQty,
                'balance_after' => $newBalance,
                'remarks' => 'Used in dental treatment',
                'performed_by' => 1,
            ]);

            // 3. Adjustment example (optional)
            if (rand(0, 1)) {
                $adjustQty = rand(1, 5);

                $finalBalance = $newBalance + $adjustQty;

                StockMovement::create([
                    'stock_movement_uuid' => Str::uuid(),
                    'product_uuid' => $product->product_uuid,
                    'type' => 'adjustment',
                    'reference_type' => 'manual',
                    'reference_id' => Str::uuid(),
                    'quantity' => $adjustQty,
                    'balance_after' => $finalBalance,
                    'remarks' => 'Stock correction',
                    'performed_by' => 1,
                ]);
            }
        }
    }
}
