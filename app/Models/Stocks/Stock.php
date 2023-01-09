<?php

namespace App\Models\Stocks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_code', 'product_code');
    }
}
