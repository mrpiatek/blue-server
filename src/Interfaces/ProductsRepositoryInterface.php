<?php

namespace MrPiatek\BlueServer\Interfaces;


use Illuminate\Support\Collection;
use MrPiatek\BlueServer\Models\Product;
use MrPiatek\BlueServer\Exceptions\InvalidAmountException;

interface ProductsRepositoryInterface
{
    /**
     * Gets all products that are in stock.
     *
     * @return Collection<Product> Collection of products
     */
    public function getProductsInStock(): Collection;

    /**
     * Gets all products that are out of stock.
     *
     * @return Collection<Product> Collection of products
     */
    public function getProductsOutOfStock(): Collection;

    /**
     * Gets all products with amount greater than given value.
     *
     * @param int $amount Value
     *
     * @return Collection<Product> Collection of products
     *
     * @throws InvalidAmountException
     */
    public function getProductsWithAmountOver(int $amount): Collection;

    /**
     * Adds new product.
     *
     * @param Product $product Product data
     *
     * @return void
     */
    public function addNewProduct(Product $product): void;

    /**
     * Removes product with given ID.
     *
     * @param int $productId Product ID
     *
     * @return void
     */
    public function removeProduct(int $productId): void;

    /**
     * Updates product with given ID with data provided.
     *
     * @param Product $product Product data
     *
     * @return void
     */
    public function updateProduct(Product $product): void;
}