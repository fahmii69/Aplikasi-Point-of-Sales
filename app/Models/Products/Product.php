<?php

namespace App\Models\Products;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_code');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_code');
    }
}
