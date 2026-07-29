<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\TreatmentAttachment;
use App\Enums\TreatmentStatus;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Treatment extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $table = 'tbltreatment';
    protected $primaryKey = 'treatment_uuid';
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'treatment_uuid',
        'appointment_uuid',
        'patient_uuid',
        'staff_uuid',
        'chief_complaint',
        'history_of_complaint',
        'past_medical_history',
        'past_dental_history',
        'extra_intra_oral_examination',
        'radiographic_examination',
        'diagnosis',
        'treatment',
        'notes',
        'need_follow_up',
        'follow_up_date',
        'status',
    ];

    protected $casts = [
        'need_follow_up' => 'boolean',
        'follow_up_date' => 'date',
        'status' => TreatmentStatus::class,
    ];

    // Auto-generate UUID on create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->treatment_uuid) {
                $model->treatment_uuid = (string) Str::uuid();
            }
        });
    }

    // =========================
    // Relationships
    // =========================

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_uuid', 'appointment_uuid');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_uuid', 'patient_uuid');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_uuid', 'staff_uuid');
    }

    /**
     * A treatment can have up to 20 file attachments (X-rays, photos, PDFs, etc.).
     * Files are stored on the tenant-scoped public disk.
     */
    public function attachments()
    {
        return $this->hasMany(TreatmentAttachment::class, 'treatment_uuid', 'treatment_uuid');
    }
}
