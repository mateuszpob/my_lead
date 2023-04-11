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
        $product = new Product();
        $product->id = $this->generateId();
        $product->name = $productData['name'];
        $product->description = $productData['description'];
        $this->save($product);
        return $product;
    }
    public function getProduct(int $id) : ?Product
    {
        return $this->products[$id] ?? null;
    }

    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection
    {
        return Collection::make($this->products);
    }

    public function delete(Product $product) : void
    {
        unset($this->products[$product->id]);
    }

    private function generateId($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
