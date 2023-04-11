<?php

namespace App\Models\ProductPrice;

use App\Casts\SimplePriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'product_id'
    ];

    protected $casts = [
        'price' => SimplePriceCast::class
    ];
}
