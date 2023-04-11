<?php

namespace App\Models\ProductPrice;

use Illuminate\Database\Eloquent\Collection;

class ProductPriceRepositoryEloquent implements ProductPriceRepositoryInterface
{
    public function save(ProductPrice $productPrice): void
    {
        $productPrice->save();
    }

    public function create(float $price, int $productId): ProductPrice
    {
        return ProductPrice::create([
            'price' => $price,
            'product_id' => $productId
        ]);
    }

    public function getByProductId(int $productId) : Collection
    {
        return ProductPrice::where('product_id', $productId)->get();
    }

    public function delete(Collection $prices) : void
    {
        foreach($prices as $price)
        {
            $price->delete();
        }
    }
}
