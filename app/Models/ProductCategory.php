<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class ProductCategory extends Model
{
    protected $table = 'tblproduct_categories';

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_uuid', 'product_category_uuid');
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
