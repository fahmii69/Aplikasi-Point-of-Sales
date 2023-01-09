<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['category_name', 'isModifier', 'status'];

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_code');
    }
}
