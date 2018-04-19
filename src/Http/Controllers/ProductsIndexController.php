<?php

namespace MrPiatek\BlueServer\Http\Controllers;

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

    public function inStock()
    {
        return ProductResource::collection($this->productsRepository->getProductsInStock());
    }

    public function outOfStock()
    {
        return ProductResource::collection($this->productsRepository->getProductsOutOfStock());
    }

    public function amountOverFive()
    {
        return ProductResource::collection($this->productsRepository->getProductsWithAmountOver(5));
    }
}
