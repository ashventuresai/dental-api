<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsentForm extends Model
{
    use HasFactory;

    protected $table = 'tblconsentforms'; // change if your table name differs

    protected $fillable = [
        'consent_uuid',
        'patient_name',
        'patient_ic_no',
        'patient_dob',
        'patient_occupation',
        'patient_status',
        'patient_sex',

        'patient_address_line1',
        'patient_address_line2',
        'patient_address_postcode',
        'patient_address_city',
        'patient_address_country',
        'patient_address_state',

        'patient_contact_no',
        'patient_relative_contact_no',
        'patient_home_contact_no',
        'patient_office_contact_no',

        'patient_medical_problem',
        'patient_disease_history',

        'signature_path',
        'signed_at',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
    ];
}
