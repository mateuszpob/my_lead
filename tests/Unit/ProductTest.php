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
    use CreatesApplication;

    protected function setUp() : void
    {
        parent::setUp();
        app()->bind(CreateProductServiceInterface::class, function() {
            return new ProductService(new ProductRepositoryMem(), new ProductPriceRepositoryMem());
        });
    }

    // public function __construct(private CreateProductServiceInterface $service){}
    public function test_create_product(): void
    {
        $service = new ProductService(new ProductRepositoryMem(), new ProductPriceRepositoryMem());
        $product = $service->createProduct(['name' => 'name', 'description' => 'description'], [1, 2, 3]);
        var_dump($product);
        $this->assertTrue(true);
    }
}
