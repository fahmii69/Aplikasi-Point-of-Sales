<?php

namespace App\Models\Products;

use App\Models\Stocks\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

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
        return $this->belongsTo(Modifier::class, 'modifier_code', 'modifier_code');
    }
}
