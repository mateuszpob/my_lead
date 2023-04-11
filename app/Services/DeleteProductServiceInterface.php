<?php

namespace App\Services;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Collection;

interface DeleteProductServiceInterface
{
    public function deleteProduct(Product $product) : void;
}
