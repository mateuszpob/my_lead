<?php

namespace App\Services;

interface CreateProductServiceInterface
{
    public function createProduct(array $productData, array $prices) : void;
}
