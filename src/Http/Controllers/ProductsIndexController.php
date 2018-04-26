<?php

namespace MrPiatek\BlueServer\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use MrPiatek\BlueServer\Http\Resources\ProductResource;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;

class ProductsIndexController extends BaseController
{
    /**
     * @var ProductsRepositoryInterface
     */
    private $productsRepository;

    /**
     * ProductsIndexController constructor.
     *
     * @param ProductsRepositoryInterface $productsRepository
     */
    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Returns Resource Collection with all products in stock.
     *
     * @return ResourceCollection
     */
    public function inStock(): ResourceCollection
    {
        return ProductResource::collection($this->productsRepository->getProductsInStock());
    }

    /**
     * Returns Resource Collection with all products out of stock.
     *
     * @return ResourceCollection
     */
    public function outOfStock(): ResourceCollection
    {
        return ProductResource::collection($this->productsRepository->getProductsOutOfStock());
    }

    /**
     * Returns Resource Collection with all products with amount over five.
     *
     * @return ResourceCollection
     */
    public function amountOverFive(): ResourceCollection
    {
        return ProductResource::collection($this->productsRepository->getProductsWithAmountOver(5));
    }
}
