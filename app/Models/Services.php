<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Appointment;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Services extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $table = 'tblservices';

    protected $fillable = [
        'service_uuid',
        'service_code',
        'service_name',
        'service_category',
        'service_price',
        'service_description',
        'service_active'
    ];
}
