<?php

namespace App\Services;

use App\Models\Product\Product;
use App\Models\Product\ProductRepositoryInterface;
use App\Models\ProductPrice\ProductPriceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements CreateProductServiceInterface, GetProductsServiceInterface, EditProductServiceInterface, DeleteProductServiceInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepositiory,
        private ProductPriceRepositoryInterface $productPriceRepositiory
    )
    {}

    public function createProduct(array $productData, array $prices) : void
    {
        $product = $this->productRepositiory->create($productData);
        $this->addPricesToProduct($product, $prices);
    }

    public function getProducts(int $limit, int $offset, ?string $order, ?string $sort) : Collection
    {
        return $this->productRepositiory->getProducts($limit, $offset, $order, $sort);
    }

    public function editProduct(Product $product, array $productParams) : void
    {
        $product->name = $productParams['name'];
        $product->description = $productParams['description'];
        $this->addPricesToProduct($product, $productParams['prices']);
        $this->productRepositiory->save($product);
    }

    public function deleteProduct(Product $product) : void
    {
        $this->productRepositiory->delete($product);
    }

    private function addPricesToProduct(Product $product, array $productPrices)
    {
        $this->productPriceRepositiory->delete($product->prices);
        foreach($productPrices as $price)
        {
            if(!is_numeric($price))
            {
                continue;
            }
            $this->productPriceRepositiory->create($price, $product->id);
        }
    }

}

