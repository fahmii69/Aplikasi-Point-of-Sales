<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Modifier extends Model
{
    use HasFactory;

    protected $fillable = ['modifier_code', 'status'];

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'modifier_code');
    }
}
