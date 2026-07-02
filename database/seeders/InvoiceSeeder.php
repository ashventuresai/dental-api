<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = [
            [
                'invoice_uuid' => '30ac40ac-6dce-a6a3-6ae1d691c922',
                'appointment_uuid' => '30ac4011-6dce-4de2-a6a3-6ae1d691c922',
                'patient_uuid' => '22e7eab0-90f2-4a94-ad66-7d9fc11cf968',
                'subtotal' => 180.00,
                'discount' => 20.00,
                'total' => 160.00,
                'status' => 'partially_paid',
                'issued_at' => '2026-07-01 09:00:00',
                'created_at' => '2026-07-01 09:00:00',
                'updated_at' => '2026-07-01 09:00:00',
            ],
            [
                'invoice_uuid' => '30ac40ac-6dce-4de2-6ae1d691c922',
                'appointment_uuid' => '30ac4012-6dce-3452-a6a3-6ae1d691c922',
                'patient_uuid' => 'ef3e03e5-e0b6-4a6e-b99b-263333164dce',
                'subtotal' => 95.00,
                'discount' => 0.00,
                'total' => 95.00,
                'status' => 'unpaid',
                'issued_at' => '2026-07-01 10:00:00',
                'created_at' => '2026-07-01 10:00:00',
                'updated_at' => '2026-07-01 10:00:00',
            ],
        ];

        DB::table('tblinvoices')->insert($invoices);
    }
}
