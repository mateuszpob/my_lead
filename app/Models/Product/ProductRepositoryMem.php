<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Collection;

class ProductRepositoryMem implements ProductRepositoryInterface
{
    private array $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function save(Product $product): void
    {
        $this->products[$product->id] = $product;
    }

    public function create(array $productData): Product
    {
        return Product::create($productData);
    }

    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection
    {
        return collect($this->products);
    }
}
