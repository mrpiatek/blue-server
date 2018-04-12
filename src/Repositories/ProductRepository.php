<?php

namespace MrPiatek\BlueServer\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use MrPiatek\BlueServer\Entities\Product as ProductEntity;
use MrPiatek\BlueServer\Exceptions\InvalidAmountException;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;

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
     * Parses Laravel Collection to a ProductEntity array.
     *
     * @param Collection $productsCollection
     * @return ProductEntity[]
     */
    private function parseResults(Collection $productsCollection): array
    {
        $result = [];
        foreach ($productsCollection as $productModel) {
            $product = (object)$productModel;
            $result[] = new ProductEntity(
                $product->id,
                $product->name,
                $product->amount
            );
        }

        return $result;
    }

    /**
     * Gets all products that are in stock.
     *
     * @return ProductEntity[] Array of products
     */
    public function getProductsInStock(): array
    {
        $productsCollection = $this->model
            ->newQuery()
            ->where('amount', '>', 0)
            ->get();

        return $this->parseResults($productsCollection);
    }

    /**
     * Gets all products that are out of stock.
     *
     * @return ProductEntity[] Array of products
     */
    public function getProductsOutOfStock(): array
    {
        $productsCollection = $this->model
            ->newQuery()
            ->where('amount', '=', 0)
            ->get();

        return $this->parseResults($productsCollection);
    }

    /**
     * Gets all products with amount greater than given value.
     *
     * @param int $amount Value
     *
     * @return ProductEntity[] Array of products
     *
     * @throws InvalidAmountException
     */
    public function getProductsWithAmountOver(int $amount): array
    {
        if ($amount < 0) {
            throw new InvalidAmountException();
        }

        $productsCollection = $this->model
            ->newQuery()
            ->where('amount', '>', $amount)
            ->get();

        return $this->parseResults($productsCollection);
    }

    /**
     * Adds new product.
     *
     * @param ProductEntity $product Product data
     *
     * @return void
     */
    public function addNewProduct(ProductEntity $product): void
    {
        $this->model->newQuery()->create([
            'name' => $product->getName(),
            'amount' => $product->getAmount()
        ]);
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
     * @param ProductEntity $product Product data
     *
     * @return void
     */
    public function updateProduct(ProductEntity $product): void
    {
        $this->model
            ->newQuery()
            ->where('id', '=', $product->getId())
            ->update([
                'name' => $product->getName(),
                'amount' => $product->getAmount()
            ]);
    }
}
