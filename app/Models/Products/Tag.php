<?php

namespace App\Models\Products;

use App\Models\Products\ProductTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function productTag()
    {
        return $this->hasMany(ProductTag::class, 'tag_id');
    }
}
