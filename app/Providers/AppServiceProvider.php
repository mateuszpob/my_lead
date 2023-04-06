<?php

namespace App\Providers;

use App\Models\Product\ProductRepositoryEloquent;
use App\Services\CreateProductServiceInterface;
use App\Services\GetProductsServiceInterface;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CreateProductServiceInterface::class, function ($app) {
            return new ProductService(new ProductRepositoryEloquent());
        });

        $this->app->singleton(GetProductsServiceInterface::class, function ($app) {
            return new ProductService(new ProductRepositoryEloquent());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
