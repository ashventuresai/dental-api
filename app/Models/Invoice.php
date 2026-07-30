<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

use App\Models\InvoiceItem;
use App\Models\Payment;

class Invoice extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $table = 'tblinvoices';
    protected $primaryKey = 'invoice_uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'invoice_uuid',
        'subtotal',
        'discount',
        'total',
        'status',
        'issued_at',
        'appointment_uuid',
        'patient_uuid',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'issued_at' => 'datetime',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_uuid', 'appointment_uuid');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_uuid', 'patient_uuid');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_uuid', 'invoice_uuid');
    }

    public function invoiceitems()
    {
        return $this->items();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_uuid', 'invoice_uuid');
    }
}
