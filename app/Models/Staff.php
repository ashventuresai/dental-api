<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Staff extends Model implements Auditable
{
    use AuditableTrait;
    
    protected $table = 'tblstaff';

    protected $fillable = [
        'staff_uuid',
        'staff_id',
        'full_name',
        'position',
        'ic_no',
        'phone_no',
        'start_date',
        'end_date',
        'marital_status',
        'spouse_name',
        'spouse_ic',
        'spouse_phone_no',
        'total_independants',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'staff_uuid', 'staff_uuid');
    }
}
