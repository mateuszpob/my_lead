<?php

namespace App\Models\Product;

use App\Models\ProductPrice\ProductPrice;
use Illuminate\Database\Eloquent\Collection;

class ProductRepositoryEloquent implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        $product->save();
    }

    public function create(array $productData): Product
    {
        return Product::create($productData);
    }

    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection
    {
        $query = Product::query()->take($limit)->offset($offset);
        if(!is_null($order) && !is_null($sort))
        {
            $query->orderBy($order, $sort);
        }
        return $query->get();
    }

    public function delete(Product $product) : void
    {
        $product->delete();
    }
}
