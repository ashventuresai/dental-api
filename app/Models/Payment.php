<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Invoice;

class Payment extends Model
{
    protected $table = 'tblpayments';
    protected $primaryKey = 'payment_uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'payment_uuid',
        'amount',
        'method',
        'status',
        'reference_no',
        'paid_at',
        'invoice_uuid'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_uuid', 'invoice_uuid');
    }
}
