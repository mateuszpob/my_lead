<?php

namespace App\Models\ProductPrice;

use Illuminate\Database\Eloquent\Collection;

interface ProductPriceRepositoryInterface
{
    public function save(ProductPrice $productPrice): void;
    public function create(float $price, int $productId): ProductPrice;
    public function delete(Collection $prices) : void;
}
