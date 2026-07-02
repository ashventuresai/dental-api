<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $appointments = [
            [
                'appointment_uuid' => '30ac4011-6dce-4de2-a6a3-6ae1d691c922',
                'staff_uuid' => '30ac40ac-6dce-4de2-a6a3-6ae1d691c922',
                'patient_uuid' => '22e7eab0-90f2-4a94-ad66-7d9fc11cf968',
                'patient_name' => 'Muhammad Saiful Rahmat',
                'patient_ic_no' => '980402056587',
                'appointment_datetime' => '2026-06-24 19:26:17',
                'status' => 'Booked',
                'reason' => 'Jalan Anggerik 4',
                'notes' => 'Checkup',
                'patient_medical_problem' => 'Takda',
                'patient_disease_history' => 'TIADA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'appointment_uuid' => '30ac4011-6dce-3452-a6a3-6ae1d691c922',
                'staff_uuid' => '30ac40ac-6dce-3452-a6a3-6ae1d691c922',
                'patient_uuid' => 'ef3e03e5-e0b6-4a6e-b99b-263333164dce',
                'patient_name' => 'Hanif Binti Ramly',
                'patient_ic_no' => '920506659888',
                'appointment_datetime' => '2026-06-24 19:26:17',
                'status' => 'Completed',
                'reason' => 'Jalan Anggerik 4',
                'notes' => 'Checkup',
                'patient_medical_problem' => 'Takda',
                'patient_disease_history' => 'TIADA',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Appointment::insert($appointments);
    }
}
