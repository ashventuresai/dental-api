<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

use App\Models\Product;

class AppointmentTreatmentProduct extends Model implements Auditable
{
    protected $table = 'tblappointment_treatment_products';

    protected $fillable = [
        'appointment_uuid',
        'product_uuid',
        'quantity',
        'unit_price',
        'total_price',
        'remarks',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_uuid', 'product_uuid');
    }
}
