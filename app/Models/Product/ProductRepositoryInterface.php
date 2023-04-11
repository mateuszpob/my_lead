<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;
    public function create(array $productData): Product;
    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection;
    public function delete(Product $product) : void;
}
