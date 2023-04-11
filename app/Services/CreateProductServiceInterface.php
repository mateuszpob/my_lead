<?php

namespace App\Services;

use App\Models\Product\Product;

interface CreateProductServiceInterface
{
    public function createProduct(array $productData, array $prices) : Product;
}
