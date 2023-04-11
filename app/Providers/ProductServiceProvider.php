<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product\ProductRepositoryEloquent;
use App\Models\ProductPrice\ProductPriceRepositoryEloquent;
use App\Services\CreateProductServiceInterface;
use App\Services\DeleteProductServiceInterface;
use App\Services\EditProductServiceInterface;
use App\Services\GetProductsServiceInterface;
use App\Services\ProductService;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CreateProductServiceInterface::class, function ($app) {
            return new ProductService(new ProductRepositoryEloquent(), new ProductPriceRepositoryEloquent());
        });

        $this->app->singleton(GetProductsServiceInterface::class, function ($app) {
            return new ProductService(new ProductRepositoryEloquent(), new ProductPriceRepositoryEloquent());
        });

        $this->app->singleton(EditProductServiceInterface::class, function ($app) {
            return new ProductService(new ProductRepositoryEloquent(), new ProductPriceRepositoryEloquent());
        });

        $this->app->singleton(DeleteProductServiceInterface::class, function ($app) {
            return new ProductService(new ProductRepositoryEloquent(), new ProductPriceRepositoryEloquent());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
