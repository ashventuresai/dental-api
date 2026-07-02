<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Appointment;

class Services extends Model
{
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
