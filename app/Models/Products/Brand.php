<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['brand_code', 'status'];

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'brand_code');
    }
}
