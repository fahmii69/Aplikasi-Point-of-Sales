<?php

namespace App\Models\Products;

use App\Models\Stocks\Stock;
use App\Models\Stocks\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];
    protected $appends = [
        'total_inventory'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_code', 'supplier_code');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_code', 'category_code');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_code', 'brand_code');
    }

    public function modifier()
    {
        return $this->hasMany(ProductModifier::class, 'product_code', 'product_code');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_code', 'product_code');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_code', 'product_code');
    }

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_code', 'product_code');
    }

    public function getTotalInventoryAttribute()
    {
        return $this->stocks?->sum('stock_quantity');
    }

    public function tag()
    {
        return $this->hasMany(ProductTag::class, 'product_code', 'product_code');
    }
}
