<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface GetProductsServiceInterface
{
    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection;
}
