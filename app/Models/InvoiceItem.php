<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'tblinvoice_items';

    protected $fillable = [
        'appointment_uuid',
        'item_type',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'invoice_uuid'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_uuid', 'invoice_uuid');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_uuid', 'appointment_uuid');
    }
}
