<?php

namespace App\Models\Product;

use App\Models\ProductPrice\ProductPrice;
use Illuminate\Database\Eloquent\Collection;

class ProductRepositoryEloquent implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        unset($product->prices);
        $product->save();
    }

    public function create(array $productData) : Product
    {
        $product = Product::create($productData);
        $product->prices = new Collection();
        return $product;
    }

    public function getProduct(int $id) : ?Product
    {
        return Product::find($id);
    }

    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection
    {
        $query = Product::query()->select(["id", "name"])->take($limit)->offset($offset);
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
