<?php

namespace App\Models;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = ['name', 'default_markup'];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
}
