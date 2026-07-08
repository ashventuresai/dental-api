<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'id',
        'clinic_name',
        'clinic_legal_name',
        'clinic_registration_no',
        'clinic_code',
        'clinic_email',
        'clinic_phone',
        'clinic_website',
        'clinic_address1',
        'clinic_address2',
        'clinic_address3',
        'clinic_receipt_footer',
        'clinic_invoice_footer',
    ];

    public function getDatabaseName(): string
    {
        return 'tenant_' . $this->id;
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'clinic_name',
            'clinic_legal_name',
            'clinic_registration_no',
            'clinic_code',
            'clinic_email',
            'clinic_phone',
            'clinic_website',
            'clinic_address1',
            'clinic_address2',
            'clinic_address3',
            'clinic_receipt_footer',
            'clinic_invoice_footer',
        ];
    }
}
