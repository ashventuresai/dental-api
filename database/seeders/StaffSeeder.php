<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::updateOrCreate([
            'staff_id'=> 'E_00001',
            'ic_no'=> '910303-03-3516',
        ],
        [
            'staff_uuid'=> Str::uuid(),
            'full_name'=> 'Dr Lim Wei Chen',
            'position'=> 'Dentist',
            'phone_no'=> '0162356659',
            'start_date'=> now(),
            'end_date'=> null,
            'marital_status'=> 'Married',
            'spouse_name'=> null,
            'spouse_ic'=> null,
            'spouse_phone_no'=> null,
            'total_independants'=> 0,
            'emergency_contact_name'=> null,
            'emergency_contact_phone'=> "123123",
            'status'=> 'Active'
        ]);

        Staff::updateOrCreate([
            'staff_id'=> 'E_00002',
            'ic_no'=> '920422-05-3516',
        ],
        [
            'staff_uuid'=> Str::uuid(),
            'full_name'=> 'Dr Khairunnisa Helmy',
            'position'=> 'Dentist',
            'phone_no'=> '0166456659',
            'start_date'=> now(),
            'end_date'=> null,
            'marital_status'=> 'Single',
            'spouse_name'=> null,
            'spouse_ic'=> null,
            'spouse_phone_no'=> null,
            'total_independants'=> 0,
            'emergency_contact_name'=> null,
            'emergency_contact_phone'=> "123123",
            'status'=> 'Active'
        ]);

        Staff::updateOrCreate([
            'staff_id'=> 'E_00003',
            'ic_no'=> '950506-05-2636',
        ],
        [
            'staff_uuid'=> '30ac40ac-6dce-4de2-a6a3-6ae1d691c922',
            'full_name'=> 'Dr Nurul Ain',
            'position'=> 'Nurse',
            'phone_no'=> '0166456659',
            'start_date'=> now(),
            'end_date'=> null,
            'marital_status'=> 'Single',
            'spouse_name'=> null,
            'spouse_ic'=> null,
            'spouse_phone_no'=> null,
            'total_independants'=> 0,
            'emergency_contact_name'=> null,
            'emergency_contact_phone'=> "123123",
            'status'=> 'Active'
        ]);

        Staff::updateOrCreate([
            'staff_id'=> 'E_00004',
            'ic_no'=> '950506-05-2258',
        ],
        [
            'staff_uuid'=> '30ac40ac-6dce-3452-a6a3-6ae1d691c922',
            'full_name'=> 'Dr Muhammad Huzaifa',
            'position'=> 'Nurse',
            'phone_no'=> '0166456611',
            'start_date'=> now(),
            'end_date'=> null,
            'marital_status'=> 'Single',
            'spouse_name'=> null,
            'spouse_ic'=> null,
            'spouse_phone_no'=> null,
            'total_independants'=> 0,
            'emergency_contact_name'=> null,
            'emergency_contact_phone'=> "123123",
            'status'=> 'Active'
        ]);
    }
}
