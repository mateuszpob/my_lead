<?php

namespace App\Models\Product;

use App\Models\ProductPrice\ProductPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $appends = [
        'prices'
    ];

    public function getPricesAttribute()
    {
        return $this->prices()->get();
    }

    public function prices() : HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }
}
