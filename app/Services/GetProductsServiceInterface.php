<?php

namespace App\Services;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Collection;

interface GetProductsServiceInterface
{
    public function getProduct(int $id) : ?Product;
    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection;
}
