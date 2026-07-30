<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Appointment;

class Patient extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $table = 'tblpatients';
    protected $primaryKey = 'patient_uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'patient_uuid',
        'firstname',
        'lastname',
        'middlename',
        'id_type',
        'ic_no',
        'passport_no',
        'addressline1',
        'addressline2',
        'postalcode',
        'city',
        'state',
        'country',
        'sex',
        'age',
        'date_of_birth',
        'contact_no',
        'emergency_name_1',
        'emergency_phone_1',
        'emergency_relationship_1',
        'emergency_name_2',
        'emergency_phone_2',
        'emergency_relationship_2',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_uuid', 'patient_uuid');
    }

}
