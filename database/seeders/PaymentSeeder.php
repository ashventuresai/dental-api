<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tblpayments')->updateOrInsert(
            [
                'payment_uuid' => '30ac40ac-6dce-54654-6ae1d691c922',
            ],
            [
                'invoice_uuid' => '330ac40ac-6dce-a6a3-6ae1d691c922',
                'amount' => 100.00,
                'method' => 'cash',
                'status' => 'success',
                'reference_no' => 'RC-000001',
                'paid_at' => '2026-07-01 09:15:00',
                'created_at' => '2026-07-01 09:15:00',
                'updated_at' => '2026-07-01 09:15:00',
            ]
        );

        DB::table('tblpayments')->updateOrInsert(
            [
                'payment_uuid' => '30ac40ac-6dce-7867-6ae1d691c922',
            ],
            [
                'invoice_uuid' => '30ac40ac-6dce-4de2-6ae1d691c922',
                'amount' => 60.00,
                'method' => 'card',
                'status' => 'success',
                'reference_no' => 'RC-000002',
                'paid_at' => '2026-07-01 09:30:00',
                'created_at' => '2026-07-01 09:30:00',
                'updated_at' => '2026-07-01 09:30:00',
            ],
        );

    }
}
