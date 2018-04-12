<?php

namespace MrPiatek\BlueServer\Controllers;

use Illuminate\Routing\Controller as BaseController;
use MrPiatek\BlueServer\Entities\Product;
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


    public function indexInStock()
    {
        $data = $this->productsRepository->getProductsInStock();

        $result = array_map(function (Product $product) {
            return $product->toArray();
        }, $data);

        return response()->json($result);
    }

    public function indexOutOfStock()
    {
        $data = $this->productsRepository->getProductsOutOfStock();

        $result = array_map(function (Product $product) {
            return $product->toArray();
        }, $data);

        return response()->json($result);
    }

    public function indexAmountOverFive()
    {
        $data = $this->productsRepository->getProductsWithAmountOver(5);

        $result = array_map(function (Product $product) {
            return $product->toArray();
        }, $data);

        return response()->json($result);
    }
}
