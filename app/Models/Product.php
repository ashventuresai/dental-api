<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Enums\ProductType;
use App\Models\ProductCategory;
use App\Models\ProductUnit;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'tblproducts';

    protected $fillable = [
        'product_uuid',
        'product_code',
        'barcode',
        'name',
        'generic_name',
        'product_category_uuid',
        'product_unit_uuid',
        'brand',
        'type',
        'purchase_price',
        'selling_price',
        'minimum_stock',
        'current_stock',
        'description',
        'is_active'
    ];

    protected $casts = [
        'type' => ProductType::class,
        'is_active' => 'boolean',
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    /*
    |----------------------------------------
    | RELATIONSHIPS
    |----------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_uuid', 'product_category_uuid');
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnit::class, 'product_unit_uuid', 'product_unit_uuid');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_uuid', 'appointment_uuid');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'product_uuid', 'product_uuid');
    }

    /*
    |----------------------------------------
    | SCOPES
    |----------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeMedicine($query)
    {
        return $query->where('type', ProductType::MEDICINE);
    }

    public function scopeConsumable($query)
    {
        return $query->where('type', ProductType::CONSUMABLE);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('current_stock', '<=', 'minimum_stock');
    }

    /*
    |----------------------------------------
    | ACCESSORS
    |----------------------------------------
    */

    public function getStockStatusAttribute(): string
    {
        if ($this->current_stock <= 0) {
            return 'out_of_stock';
        }

        if ($this->current_stock <= $this->minimum_stock) {
            return 'low_stock';
        }

        return 'in_stock';
    }

    public function getIsLowStockAttribute(): bool
    {
        return $this->current_stock <= $this->minimum_stock;
    }
}
