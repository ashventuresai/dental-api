<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tblpatients')->updateOrInsert(
            [
                'patient_uuid' => '22e7eab0-90f2-4a94-ad66-7d9fc11cf968',
            ],
            [
                'firstname' => 'Muhammad',
                'lastname' => 'Rahmat',
                'middlename' => 'Saiful',
                'id_type' => '1',
                'ic_no' => '980402056587',
                'passport_no' => '',
                'addressline1' => '',
                'addressline2' => '',
                'postalcode' => '',
                'city' => '',
                'state' => '',
                'country' => '',
                'sex' => 'Male',
                'age' => 27,
                'date_of_birth' => '1998-04-02',
                'contact_no' => '0192353369',
                'emergency_name_1' => '',
                'emergency_phone_1' => '',
                'emergency_relationship_1' => '',
                'emergency_name_2' => '',
                'emergency_phone_2' => '',
                'emergency_relationship_2' => '',
                'created_at' => null,
                'updated_at' => null,
            ]);

        DB::table('tblpatients')->updateOrInsert(
            [
                'patient_uuid' => 'ef3e03e5-e0b6-4a6e-b99b-263333164dce',
            ],
            [
                'firstname' => 'Hanif',
                'lastname' => 'Ramly',
                'middlename' => 'Binti',
                'id_type' => '1',
                'ic_no' => '920506659888',
                'passport_no' => '',
                'addressline1' => '',
                'addressline2' => '',
                'postalcode' => '',
                'city' => '',
                'state' => '',
                'country' => '',
                'sex' => 'Male',
                'age' => 33,
                'date_of_birth' => '2025-09-29',
                'contact_no' => '0122546577',
                'emergency_name_1' => '',
                'emergency_phone_1' => '',
                'emergency_relationship_1' => '',
                'emergency_name_2' => '',
                'emergency_phone_2' => '',
                'emergency_relationship_2' => '',
                'created_at' => '2025-09-29 17:29:15',
                'updated_at' => '2025-09-29 17:29:15',
            ]);

        DB::table('tblpatients')->updateOrInsert(
            [
                'patient_uuid' => 'ef3e03e5-e0b6-4a6e-b99b-264567864dce',
            ],
            [
                'firstname' => 'Hafiz',
                'lastname' => 'Talib',
                'middlename' => 'Bin',
                'id_type' => '1',
                'ic_no' => '980501056555',
                'passport_no' => '',
                'addressline1' => '',
                'addressline2' => '',
                'postalcode' => '',
                'city' => '',
                'state' => '',
                'country' => '',
                'sex' => 'Male',
                'age' => 26,
                'date_of_birth' => '2025-09-29',
                'contact_no' => '0125465851',
                'emergency_name_1' => '',
                'emergency_phone_1' => '',
                'emergency_relationship_1' => '',
                'emergency_name_2' => '',
                'emergency_phone_2' => '',
                'emergency_relationship_2' => '',
                'created_at' => '2025-10-01 17:29:15',
                'updated_at' => null,
            ]);

        DB::table('tblpatients')->updateOrInsert(
            [
                'patient_uuid' => 'ef3e03e5-e0b6-4a6e-b99b-261234564dce',
            ],
            [
                'firstname' => 'Ali',
                'lastname' => 'Abu',
                'middlename' => 'Bin',
                'id_type' => '1',
                'ic_no' => '970105056599',
                'passport_no' => '',
                'addressline1' => '',
                'addressline2' => '',
                'postalcode' => '',
                'city' => '',
                'state' => '',
                'country' => '',
                'sex' => 'Male',
                'age' => 28,
                'date_of_birth' => '2025-09-29',
                'contact_no' => '0123569988',
                'emergency_name_1' => '',
                'emergency_phone_1' => '',
                'emergency_relationship_1' => '',
                'emergency_name_2' => '',
                'emergency_phone_2' => '',
                'emergency_relationship_2' => '',
                'created_at' => '2025-09-29 17:29:15',
                'updated_at' => null,
            ]);

        DB::table('tblpatients')->updateOrInsert(
            [
                'patient_uuid' => 'ef3e03e5-e0b6-4a6e-b99b-2640a3164dce',
            ],
            [
                'firstname' => 'Muhammad',
                'lastname' => 'Bin Ahmad',
                'middlename' => 'Nur Asyraf',
                'id_type' => '1',
                'ic_no' => '970408055425',
                'passport_no' => '',
                'addressline1' => 'No 2, jalan mahkota',
                'addressline2' => 'taman mahkota',
                'postalcode' => '70450',
                'city' => 'seremban',
                'state' => 'Negeri Sembilan',
                'country' => 'Malaysia',
                'sex' => 'Female',
                'age' => 28,
                'date_of_birth' => '1997-04-08',
                'contact_no' => '0192659494',
                'emergency_name_1' => '',
                'emergency_phone_1' => '',
                'emergency_relationship_1' => '',
                'emergency_name_2' => '',
                'emergency_phone_2' => '',
                'emergency_relationship_2' => '',
                'created_at' => null,
                'updated_at' => null,
            ]);

        DB::table('tblpatients')->updateOrInsert(
            [
                'patient_uuid' => 'ef3e03e5-e0b6-4a6e-b99b-a3164dce',
            ],
            [
                'firstname' => 'Muhammad',
                'lastname' => 'Ali',
                'middlename' => 'Nur',
                'id_type' => 'IC',
                'ic_no' => '950506052636',
                'passport_no' => '',
                'addressline1' => 'No5',
                'addressline2' => 'Jalan Anggerik 4',
                'postalcode' => '70450',
                'city' => 'Subang',
                'state' => 'Selangor',
                'country' => 'Malaysia',
                'sex' => 'Male',
                'age' => 25,
                'date_of_birth' => '1997-04-08',
                'contact_no' => '0132769987',
                'emergency_name_1' => '',
                'emergency_phone_1' => '',
                'emergency_relationship_1' => '',
                'emergency_name_2' => '',
                'emergency_phone_2' => '',
                'emergency_relationship_2' => '',
                'created_at' => '2026-06-23 00:25:20',
                'updated_at' => '2026-06-23 00:25:20',
            ]);
    }
}
