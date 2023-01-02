<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModifierDetail extends Model
{
    use HasFactory;

    protected $fillable = ['modifier_code', 'modifier_detailName', 'modifier_price', 'status'];

    public function modifier(): HasMany
    {
        return $this->hasMany(Modifier::class, 'modifier_code');
    }
}
