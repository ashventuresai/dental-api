<?php

namespace Database\Seeders;

use App\Models\User;
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

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PatientSeeder::class,
            AutoNumberSeeder::class,
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
