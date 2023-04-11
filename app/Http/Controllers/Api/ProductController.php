<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\ProductListRequest;
use App\Models\Product\Product;
use App\Services\CreateProductServiceInterface;
use App\Services\DeleteProductServiceInterface;
use App\Services\EditProductServiceInterface;
use App\Services\GetProductsServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private GetProductsServiceInterface $getService
    )
    {

    }

    public function getProduct(int $productId, GetProductsServiceInterface $service)
    {
        $product = $this->getProductById($productId);
        return response($product, 200);
    }

    public function getProducts(ProductListRequest $request, GetProductsServiceInterface $service)
    {
        $data = $request->validated();

        $products = $service->getProducts($data['limit'], $data['offset'], $data['order'] ?? null, $data['sort'] ?? null);

        return response($products, 200);
    }

    public function createProduct(CreateProductRequest $request, CreateProductServiceInterface $service)
    {
        $productData = $request->only(['name', 'description']);
        $prices = $request->only(['prices']);
        $service->createProduct($productData, $prices['prices']);
        return response(null, 201);
    }

    public function editProduct(int $productId, EditProductServiceInterface $service, EditProductRequest $request)
    {
        $product = $this->getProductById($productId);
        $service->editProduct($product, $request->validated());
        return response($product, 200);
    }

    public function deleteProduct(int $productId, DeleteProductServiceInterface $service)
    {
        $product = $this->getProductById($productId);

        $service->deleteProduct($product);
        return response(null, 200);
    }

    private function getProductById(int $productId) : ?Product
    {
        $product =  $this->getService->getProduct($productId);
        if(is_null($product))
        {
            abort(404);
        }
        return $product;
    }
}
