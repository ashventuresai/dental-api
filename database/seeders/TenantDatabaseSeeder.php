<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PatientSeeder;
use Database\Seeders\AutoNumberSeeder;
use Database\Seeders\ServicesSeeder;
use Database\Seeders\TreatmentSeeder;
use Database\Seeders\StaffSeeder;
use Database\Seeders\ProductCategorySeeder;
use Database\Seeders\ProductUnitSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\StockMovementSeeder;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\InvoiceItemSeeder;
use Database\Seeders\PaymentSeeder;


class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AutoNumberSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PatientSeeder::class,
            ServicesSeeder::class,
            TreatmentSeeder::class,
            StaffSeeder::class,
            AppointmentSeeder::class,
            ProductCategorySeeder::class,
            ProductUnitSeeder::class,
            ProductSeeder::class,
            StockMovementSeeder::class,
            InvoiceSeeder::class,
            InvoiceItemSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
