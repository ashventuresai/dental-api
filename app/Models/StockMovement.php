<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

use App\Models\Product;
use App\Enums\StockMovementType;
use App\Enums\StockReferenceType;

class StockMovement extends Model implements Auditable
{
    use AuditableTrait;
    
    protected $table = 'tblstock_movements';

    protected $fillable = [
        'stock_movement_uuid',
        'product_uuid',
        'type',
        'reference_type',
        'reference_id',
        'quantity',
        'balance_after',
        'remarks',
        'performed_by'
    ];

    protected $casts = [
        'type' => StockMovementType::class,
        'reference_type' => StockReferenceType::class,
    ];

    /*
    |----------------------------------------
    | RELATIONSHIP
    |----------------------------------------
    */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |----------------------------------------
    | SCOPES
    |----------------------------------------
    */

    public function scopeIn($query)
    {
        return $query->where('type', StockMovementType::IN);
    }

    public function scopeOut($query)
    {
        return $query->where('type', StockMovementType::OUT);
    }

    public function scopeAdjustments($query)
    {
        return $query->where('type', StockMovementType::ADJUSTMENT);
    }
}
