<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Services;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00001',
            'service_name'=>'Scaling & Polishing',
            'service_category'=>'Preventive',
            'service_description'=>'Good',
            'service_price'=>120,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00002',
            'service_name'=>'Composite Filling 1 Surface',
            'service_category'=>'Restorative',
            'service_description'=>'Good',
            'service_price'=>100,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00003',
            'service_name'=>'Root Canal Molar',
            'service_category'=>'Endodontic',
            'service_description'=>'Good',
            'service_price'=>1200,
            'service_active'=>'Active'
        ]);
    }
}
