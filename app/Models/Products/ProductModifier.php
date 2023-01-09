<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModifier extends Model
{
    use HasFactory;

    protected $fillable = ['product_modifierCode', 'product_code', 'modifier_code', 'status'];
}
