<?php

namespace MrPiatek\BlueServer\Interfaces;


use MrPiatek\BlueServer\Entities\Product;
use MrPiatek\BlueServer\Exceptions\InvalidAmountException;
use MrPiatek\BlueServer\Exceptions\InvalidProductIdException;

interface ProductsRepositoryInterface
{
    /**
     * Gets all products that are in stock.
     *
     * @return Product[] Array of products
     */
    public function getProductsInStock(): array;

    /**
     * Gets all products that are out of stock.
     *
     * @return Product[] Array of products
     */
    public function getProductsOutOfStock(): array;

    /**
     * Gets all products with amount greater than given value.
     *
     * @param int $amount Value
     *
     * @return Product[] Array of products
     *
     * @throws InvalidAmountException
     */
    public function getProductsWithAmountOver(int $amount): array;

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
     *
     * @throws InvalidProductIdException
     */
    public function removeProduct(int $productId): void;

    /**
     * Updates product with given ID with data provided.
     *
     * @param int $productId Product ID
     * @param Product $product Product data
     *
     * @return void
     *
     * @throws InvalidProductIdException
     */
    public function updateProduct(int $productId, Product $product): void;
}