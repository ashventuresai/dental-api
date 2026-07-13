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
            'service_name'=>'ANTERIOR IMPLANT CROWN',
            'service_category'=>'IMPLANT',
            'service_description'=>'Good',
            'service_price'=>7500,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00002',
            'service_name'=>'POSTERIOR IMPLANT CROWN',
            'service_category'=>'COBALT CROMIUM DENTURE',
            'service_description'=>'Good',
            'service_price'=>6500,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00003',
            'service_name'=>'COBALT CROMIUM',
            'service_category'=>'COBALT CROMIUM DENTURE',
            'service_description'=>'Good',
            'service_price'=>700,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00004',
            'service_name'=>'ACRYLIC BASE',
            'service_category'=>'COBALT CROMIUM DENTURE',
            'service_description'=>'Good',
            'service_price'=>150,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00005',
            'service_name'=>'1 BATANG GIGI',
            'service_category'=>'COBALT CROMIUM DENTURE',
            'service_description'=>'Good',
            'service_price'=>35,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00006',
            'service_name'=>'WIRE MESH',
            'service_category'=>'COBALT CROMIUM DENTURE',
            'service_description'=>'Good',
            'service_price'=>150,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00007',
            'service_name'=>'CLASP 1 UNIT',
            'service_category'=>'COBALT CROMIUM DENTURE',
            'service_description'=>'Good',
            'service_price'=>50,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00008',
            'service_name'=>'TAPAK',
            'service_category'=>'FLEXIBLE DENTURE',
            'service_description'=>'Good',
            'service_price'=>1050,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00009',
            'service_name'=>'1 BATANG GIGI',
            'service_category'=>'FLEXIBLE DENTURE',
            'service_description'=>'Good',
            'service_price'=>45,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00010',
            'service_name'=>'ZIRCONIA / FULL PORCELAIN 1 UNIT',
            'service_category'=>'CROWN/BRIDGE',
            'service_description'=>'Good',
            'service_price'=>1200,
            'service_active'=>'Active'
        ]);


        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00011',
            'service_name'=>'PFM 1 UNIT',
            'service_category'=>'CROWN/BRIDGE',
            'service_description'=>'Good',
            'service_price'=>700,
            'service_active'=>'Active'
        ]);


        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00012',
            'service_name'=>'FULL METAL 1 UNIT',
            'service_category'=>'CROWN/BRIDGE',
            'service_description'=>'Good',
            'service_price'=>600,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00013',
            'service_name'=>'HAWLEY',
            'service_category'=>'RETAINER',
            'service_description'=>'Good',
            'service_price'=>800,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00014',
            'service_name'=>'ESSIX',
            'service_category'=>'RETAINER',
            'service_description'=>'Good',
            'service_price'=>600,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00015',
            'service_name'=>'FIXED BONDED',
            'service_category'=>'RETAINER',
            'service_description'=>'Good',
            'service_price'=>600,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00016',
            'service_name'=>'SCALING',
            'service_category'=>'PROPHYLAXIS',
            'service_description'=>'Good',
            'service_price'=>300,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00017',
            'service_name'=>'FILLING',
            'service_category'=>'RESTORATIVE',
            'service_description'=>'Good',
            'service_price'=>300,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00018',
            'service_name'=>'EXTRACTION',
            'service_category'=>'SURGICAL',
            'service_description'=>'Good',
            'service_price'=>600,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00019',
            'service_name'=>'SURGICAL EXTRACTION',
            'service_category'=>'SURGICAL',
            'service_description'=>'Good',
            'service_price'=>1000,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00020',
            'service_name'=>'ROOT CANAL TREATMENT',
            'service_category'=>'ENDODONTIC',
            'service_description'=>'Good',
            'service_price'=>1000,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00021',
            'service_name'=>'WHITENING',
            'service_category'=>'COSMETIC',
            'service_description'=>'Good',
            'service_price'=>600,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00022',
            'service_name'=>'DENTURE',
            'service_category'=>'COSMETIC',
            'service_description'=>'Good',
            'service_price'=>300,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00023',
            'service_name'=>'GIGI PALSU (1x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>185,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00024',
            'service_name'=>'GIGI PALSU (2x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>220,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00025',
            'service_name'=>'GIGI PALSU (3x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>255,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00026',
            'service_name'=>'GIGI PALSU (4x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>290,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00027',
            'service_name'=>'GIGI PALSU (5x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>325,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00028',
            'service_name'=>'GIGI PALSU (6x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>360,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00029',
            'service_name'=>'GIGI PALSU (7x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>395,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00030',
            'service_name'=>'GIGI PALSU (8x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>430,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00031',
            'service_name'=>'GIGI PALSU (9x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>465,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00032',
            'service_name'=>'GIGI PALSU (10x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>500,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00033',
            'service_name'=>'GIGI PALSU (11x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>535,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00034',
            'service_name'=>'GIGI PALSU (12x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>570,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00035',
            'service_name'=>'GIGI PALSU (13x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>605,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00036',
            'service_name'=>'GIGI PALSU (14x)',
            'service_category'=>'GIGI PALSU',
            'service_description'=>'Good',
            'service_price'=>800,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00037',
            'service_name'=>'GIGI PALSU FLEXIBLE (1x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1095,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00038',
            'service_name'=>'GIGI PALSU FLEXIBLE (2x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1140,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00039',
            'service_name'=>'GIGI PALSU FLEXIBLE (3x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1185,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00040',
            'service_name'=>'GIGI PALSU FLEXIBLE (4x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1230,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00041',
            'service_name'=>'GIGI PALSU FLEXIBLE (5x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1275,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00042',
            'service_name'=>'GIGI PALSU FLEXIBLE (6x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1320,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00043',
            'service_name'=>'GIGI PALSU FLEXIBLE (7x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1365,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00044',
            'service_name'=>'GIGI PALSU FLEXIBLE (8x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1410,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00045',
            'service_name'=>'GIGI PALSU FLEXIBLE (9x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1455,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00046',
            'service_name'=>'GIGI PALSU FLEXIBLE (10x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1500,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00047',
            'service_name'=>'GIGI PALSU FLEXIBLE (11x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1545,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00048',
            'service_name'=>'GIGI PALSU FLEXIBLE (12x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1590,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00049',
            'service_name'=>'GIGI PALSU FLEXIBLE (13x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1635,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00050',
            'service_name'=>'GIGI PALSU FLEXIBLE (14x)',
            'service_category'=>'GIGI PALSU FLEXIBLE',
            'service_description'=>'Good',
            'service_price'=>1800,
            'service_active'=>'Active'
        ]);


        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00051',
            'service_name'=>'GIGI PALSU FOREIGNER (1x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>310,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00052',
            'service_name'=>'GIGI PALSU FOREIGNER (2x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>370,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00053',
            'service_name'=>'GIGI PALSU FOREIGNER (3x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>430,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00054',
            'service_name'=>'GIGI PALSU FOREIGNER (4x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>490,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00055',
            'service_name'=>'GIGI PALSU FOREIGNER (5x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>550,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00056',
            'service_name'=>'GIGI PALSU FOREIGNER (6x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>610,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00057',
            'service_name'=>'GIGI PALSU FOREIGNER (7x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>670,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00058',
            'service_name'=>'GIGI PALSU FOREIGNER (8x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>730,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00059',
            'service_name'=>'GIGI PALSU FOREIGNER (9x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>790,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00060',
            'service_name'=>'GIGI PALSU FOREIGNER (10x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>840,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00061',
            'service_name'=>'GIGI PALSU FOREIGNER (11x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>890,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00062',
            'service_name'=>'GIGI PALSU FOREIGNER (12x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>940,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00063',
            'service_name'=>'GIGI PALSU FOREIGNER (13x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>990,
            'service_active'=>'Active'
        ]);

        Services::create([
            'service_uuid'=>Str::uuid(),
            'service_code'=>'SVC_00064',
            'service_name'=>'GIGI PALSU FOREIGNER (14x)',
            'service_category'=>'GIGI PALSU FOREIGNER',
            'service_description'=>'Good',
            'service_price'=>1200,
            'service_active'=>'Active'
        ]);
    }
}
