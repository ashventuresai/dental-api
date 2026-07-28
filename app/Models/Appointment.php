<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\ConsentForm;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Treatment;
use App\Enums\AppointmentStatus;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'tblappointments';
    protected $primaryKey = 'appointment_uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        'status' => AppointmentStatus::class,
    ];

    protected $fillable = [
        'appointment_uuid',
        'staff_uuid',
        'patient_uuid',
        'consent_uuid',
        'patient_name',
        'patient_ic_no',
        'appointment_datetime',
        'status',
        'reason',
        'notes',
        'patient_medical_problem',
        'patient_disease_history',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_uuid', 'patient_uuid');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_uuid', 'staff_uuid');
    }

    public function consent()
    {
        return $this->hasOne(ConsentForm::class, 'consent_uuid', 'consent_uuid');
    }

    public function treatment()
    {
        return $this->hasOne(Treatment::class, 'appointment_uuid', 'appointment_uuid');
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'appointment_uuid', 'appointment_uuid');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'appointment_uuid', 'appointment_uuid');
    }


}
