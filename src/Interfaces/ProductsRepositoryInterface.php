<?php

namespace MrPiatek\BlueServer\Interfaces;


use MrPiatek\BlueServer\Exceptions\InvalidAmountException;

interface ProductsRepositoryInterface
{
    /**
     * Gets all products that are in stock.
     *
     * @return ProductInterface[] array of products
     */
    public function getProductsInStock(): array;

    /**
     * Gets all products that are out of stock.
     *
     * @return ProductInterface[] array of products
     */
    public function getProductsOutOfStock(): array;

    /**
     * Gets all products with amount greater than given value.
     *
     * @param int $amount Value
     *
     * @return ProductInterface[] array of products
     *
     * @throws InvalidAmountException
     */
    public function getProductsWithAmountOver(int $amount): array;

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
     * @param ProductInterface $product Product
     *
     * @return void
     */
    public function updateProduct(ProductInterface $product): void;
}