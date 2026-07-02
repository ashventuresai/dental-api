<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class ProductUnit extends Model
{
    protected $table = 'tblproduct_units';

    protected $fillable = [
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_unit_uuid', 'product_unit_uuid');
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
}
