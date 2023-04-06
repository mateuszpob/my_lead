<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductListRequest;
use App\Services\CreateProductServiceInterface;
use App\Services\GetProductsServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {

    }

    public function createProduct(CreateProductRequest $request, CreateProductServiceInterface $service)
    {
        $data = $request->validated();
        $service->createProduct($data);
        return response(null, 201);
    }

    public function getProducts(ProductListRequest $request, GetProductsServiceInterface $service)
    {
        $data = $request->validated();

        $products = $service->getProducts($data['limit'], $data['offset'], $data['order'] ?? null, $data['sort'] ?? null);

        return response($products, 200);
    }
}
