<?php

namespace MrPiatek\BlueServer\Repositories;

use Illuminate\Container\Container as App;
use MrPiatek\BlueServer\Exceptions\InvalidAmountException;
use MrPiatek\BlueServer\Interfaces\ProductInterface;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;
use MrPiatek\BlueServer\Models\Product;

class ProductRepository implements ProductsRepositoryInterface
{

    const MODEL_CLASS = Product::class;
    /**
     * @var App
     */
    private $app;

    /**
     * @var Product
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
     * @return ProductInterface[] array of products
     */
    public function getProductsInStock(): array
    {
        return $this->model
            ->newQuery()
            ->where('amount', '>', 0)
            ->get()
            ->toArray();
    }

    /**
     * Gets all products that are out of stock.
     *
     * @return ProductInterface[] array of products
     */
    public function getProductsOutOfStock(): array
    {
        return $this->model
            ->newQuery()
            ->where('amount', '=', 0)
            ->get()
            ->toArray();
    }

    /**
     * Gets all products with amount greater than given value.
     *
     * @param int $amount Value
     *
     * @return ProductInterface[] array of products
     *
     * @throws InvalidAmountException
     */
    public function getProductsWithAmountOver(int $amount): array
    {
        if ($amount < 0) {
            throw new InvalidAmountException();
        }

        return $this->model
            ->newQuery()
            ->where('amount', '>', $amount)
            ->get()
            ->toArray();
    }

    /**
     * Adds new product.
     *
     * @param ProductInterface $product Product data
     *
     * @return void
     */
    public function addNewProduct(ProductInterface $product): void
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
     * @param ProductInterface $product Product data
     *
     * @return void
     */
    public function updateProduct(ProductInterface $product): void
    {
        $this->model
            ->newQuery()
            ->where('id', '=', $product->id)
            ->update($product->toArray());
    }
}
