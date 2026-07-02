<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AutoNumber;

class AutoNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AutoNumber::insert([
            [
                'key' => 'STAFF',
                'prefix' => 'E_',
                'current_value' => 0,
                'pad_length' => 5,
                'increment' => 1,
            ],
            [
                'key' => 'INVOICE',
                'prefix' => 'INV_',
                'current_value' => 0,
                'pad_length' => 6,
                'increment' => 1,
            ],
            [
                'key' => 'RECEIPT',
                'prefix' => 'RC_',
                'current_value' => 0,
                'pad_length' => 6,
                'increment' => 1,
            ],
            [
                'key' => 'SERVICE',
                'prefix' => 'SVC_',
                'current_value' => 0,
                'pad_length' => 5,
                'increment' => 1,
            ],
            [
                'key' => 'PRODUCT',
                'prefix' => 'PRD-',
                'current_value' => 0,
                'pad_length' => 6,
                'increment' => 1,
            ],
        ]);
    }
}
