<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_code', 'product_code');
    }
}
