<?php

namespace Tests\Unit;

use App\Models\Product\ProductRepositoryMem;
use App\Models\ProductPrice\ProductPriceRepositoryMem;
use App\Services\CreateProductServiceInterface;
use App\Services\ProductService;
use Tests\TestCase;
use Tests\CreatesApplication;

class ProductTest extends TestCase
{
    private $service;

    public function setUp() : void {
        parent::setUp();
        $this->service = new ProductService(new ProductRepositoryMem(), new ProductPriceRepositoryMem());
    }

    public function test_create_product(): void
    {
        $name = 'name';
        $description = 'description';
        $product = $this->service->createProduct(['name' => $name, 'description' => $description], [1, 2, 3]);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($description, $product->description);
    }

    public function test_edit_product(): void
    {
        $name = 'name';
        $description = 'description';
        $this->service->createProduct(['name' => $name, 'description' => $description], [1, 2, 3]);

        $newName = "new_name";
        $newDescription = "new_description";
        $prices = [11.1, 12.99];
        $product = $this->service->getProducts(1, 0, null, null)->first();
        $productId = $product->id;

        $this->service->editProduct($product, ["name" => $newName, "description" => $newDescription, "prices" => $prices]);

        $editedProduct = $this->service->getProduct($productId);
        $this->assertEquals($newName, $editedProduct->name);
        $this->assertEquals($newDescription, $editedProduct->description);
    }

    public function test_delete_product(): void
    {
        $name = 'name';
        $description = 'description';
        $this->service->createProduct(['name' => $name, 'description' => $description], [1, 2, 3]);

        $product = $this->service->getProducts(1, 0, null, null)->first();
        $productId = $product->id;

        $this->service->deleteProduct($product);

        $deletedProduct = $this->service->getProduct($productId);

        $this->assertEquals(null, $deletedProduct);
    }
}
