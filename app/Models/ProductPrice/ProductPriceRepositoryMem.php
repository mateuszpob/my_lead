<?php

namespace App\Models\ProductPrice;

use Illuminate\Database\Eloquent\Collection;

class ProductPriceRepositoryMem implements ProductPriceRepositoryInterface
{
    private array $productPrices;

    public function __construct()
    {
        $this->productPrices = [];
    }

    public function save(ProductPrice $productPrice): void
    {
        $this->productPrices[$productPrice->id] = $productPrice;
    }

    public function create(float $price, int $productId): ProductPrice
    {
        $productPrice = new ProductPrice();
        $productPrice->id = $this->generateId();
        $productPrice->price = $price;
        $productPrice->product_id = $productId;
        $this->save($productPrice);
        return $productPrice;
    }

    public function delete(Collection $prices) : void
    {
        foreach($prices as $price)
        {
            unset($this->productPrices[$price->id]);
        }
    }

    private function generateId($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
