<?php

namespace MrPiatek\BlueServer\Providers;

use Illuminate\Support\ServiceProvider;
use MrPiatek\BlueServer\Interfaces\ProductInterface;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;
use MrPiatek\BlueServer\Models\Product;
use MrPiatek\BlueServer\Repositories\ProductRepository;

class BlueServerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductsRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductInterface::class, Product::class);
    }
}
