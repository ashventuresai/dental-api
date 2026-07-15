<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Treatment;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treatment::create([
            'treatment_uuid' => (string) Str::uuid(),

            'appointment_uuid' => '30ac4011-6dce-4de2-a6a3-6ae1d691c922',
            'patient_uuid' => '22e7eab0-90f2-4a94-ad66-7d9fc11cf968',
            'staff_uuid' => '30ac40ac-6dce-4de2-a6a3-6ae1d691c922',

            'chief_complaint' => 'Toothache on lower right molar for 3 days',
            'history_of_complaint' => 'Pain started gradually, worsens at night',
            'past_medical_history' => 'No known chronic illness',
            'past_dental_history' => 'Filling done 2 years ago on same tooth',

            'extra_intra_oral_examination' => 'Caries detected on tooth 46, gum inflammation present',
            'radiographic_examination' => 'X-ray shows deep caries close to pulp chamber',
            'diagnosis' => 'Irreversible pulpitis',
            'treatment' => 'Root canal treatment initiated',

            'notes' => 'Patient advised to avoid hard food and maintain oral hygiene',

            'need_follow_up' => true,
            'follow_up_date' => Carbon::now()->addDays(7),

            'status' => 'Ongoing',
        ]);
    }
}
