<?php

namespace App\Services;

use App\Models\Product\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements CreateProductServiceInterface, GetProductsServiceInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepositiory
    )
    {}

    public function createProduct(array $data) : void
    {
        $this->productRepositiory->create($data);
    }

    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection
    {
        return $this->productRepositiory->getProducts($limit, $offset, $order, $sort);
    }
}
