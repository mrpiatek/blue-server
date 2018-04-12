<?php

namespace MrPiatek\BlueServer\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use MrPiatek\BlueServer\Exceptions\InvalidAmountException;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;
use MrPiatek\BlueServer\Models\Product;

class ProductRepository implements ProductsRepositoryInterface
{

    const MODEL_CLASS = \MrPiatek\BlueServer\Models\Product::class;
    /**
     * @var App
     */
    private $app;

    /**
     * @var \MrPiatek\BlueServer\Models\Product
     */
    private $model;

    /**
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->model = $this->app->make(self::MODEL_CLASS);
    }

    /**
     * Gets all products that are in stock.
     *
     * @return Collection<Product> Collection of products
     */
    public function getProductsInStock(): Collection
    {
        return $this->model
            ->newQuery()
            ->where('amount', '>', 0)
            ->get();
    }

    /**
     * Gets all products that are out of stock.
     *
     * @return Collection<Product> Collection of products
     */
    public function getProductsOutOfStock(): Collection
    {
        return $this->model
            ->newQuery()
            ->where('amount', '=', 0)
            ->get();
    }

    /**
     * Gets all products with amount greater than given value.
     *
     * @param int $amount Value
     *
     * @return Collection<Product> Collection of products
     *
     * @throws InvalidAmountException
     */
    public function getProductsWithAmountOver(int $amount): Collection
    {
        if ($amount < 0) {
            throw new InvalidAmountException();
        }

        return $this->model
            ->newQuery()
            ->where('amount', '>', $amount)
            ->get();
    }

    /**
     * Adds new product.
     *
     * @param Product $product Product data
     *
     * @return void
     */
    public function addNewProduct(Product $product): void
    {
        $this->model->newQuery()->create($product->toArray());
    }

    /**
     * Removes product with given ID.
     *
     * @param int $productId Product ID
     *
     * @return void
     */
    public function removeProduct(int $productId): void
    {
        $this->model
            ->newQuery()
            ->where('id', '=', $productId)
            ->delete();
    }

    /**
     * Updates product with given ID with data provided.
     *
     * @param Product $product Product data
     *
     * @return void
     */
    public function updateProduct(Product $product): void
    {
        $this->model
            ->newQuery()
            ->where('id', '=', $product->id)
            ->update($product->toArray());
    }
}
