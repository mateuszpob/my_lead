<?php

namespace App\Services;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Collection;

interface EditProductServiceInterface
{
    public function editProduct(Product $product, array $productParams) : void;
}
