<?php

namespace MrPiatek\BlueServer\Interfaces;


use MrPiatek\BlueServer\Exceptions\InvalidAmountException;

interface ProductsRepositoryInterface
{
    /**
     * Gets all products that are in stock.
     *
     * @return \ArrayAccess array of products
     */
    public function getProductsInStock(): \ArrayAccess;

    /**
     * Gets all products that are out of stock.
     *
     * @return \ArrayAccess array of products
     */
    public function getProductsOutOfStock(): \ArrayAccess;

    /**
     * Gets all products with amount greater than given value.
     *
     * @param int $amount Value
     *
     * @return \ArrayAccess array of products
     *
     * @throws InvalidAmountException
     */
    public function getProductsWithAmountOver(int $amount): \ArrayAccess;

    /**
     * Adds new product.
     *
     * @param ProductInterface $product Product
     *
     * @return void
     */
    public function addNewProduct(ProductInterface $product): void;

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
     * @param int $productId
     * @param ProductInterface $product Product
     *
     * @return void
     */
    public function updateProduct(int $productId, ProductInterface $product): void;
}