<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tblinvoice_items')->insert([
            [
                'invoice_uuid' => '30ac40ac-6dce-a6a3-6ae1d691c922',
                'appointment_uuid' => '30ac4011-6dce-4de2-a6a3-6ae1d691c922',
                'item_type' => 'procedure',
                'description' => 'Scaling and polishing',
                'quantity' => 1,
                'unit_price' => 120.00,
                'total_price' => 120.00,
                'created_at' => '2026-07-01 09:00:00',
                'updated_at' => '2026-07-01 09:00:00',
            ],
            [
                'invoice_uuid' => '30ac40ac-6dce-a6a3-6ae1d691c922',
                'appointment_uuid' => '30ac4011-6dce-4de2-a6a3-6ae1d691c922',
                'item_type' => 'medicine',
                'description' => 'Amoxicillin 500mg',
                'quantity' => 2,
                'unit_price' => 30.00,
                'total_price' => 60.00,
                'created_at' => '2026-07-01 09:00:00',
                'updated_at' => '2026-07-01 09:00:00',
            ],
            [
                'invoice_uuid' => '30ac40ac-6dce-4de2-6ae1d691c922',
                'appointment_uuid' => '30ac4012-6dce-3452-a6a3-6ae1d691c922',
                'item_type' => 'consultation',
                'description' => 'Follow-up consultation',
                'quantity' => 1,
                'unit_price' => 95.00,
                'total_price' => 95.00,
                'created_at' => '2026-07-01 10:00:00',
                'updated_at' => '2026-07-01 10:00:00',
            ],
        ]);
    }
}
