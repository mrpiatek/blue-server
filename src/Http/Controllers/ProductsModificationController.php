<?php

namespace MrPiatek\BlueServer\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use MrPiatek\BlueServer\Http\Requests\StoreOrUpdateProduct;
use MrPiatek\BlueServer\Interfaces\ProductInterface;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;
use Illuminate\Container\Container as App;

class ProductsModificationController extends BaseController
{
    /**
     * @var ProductsRepositoryInterface
     */
    private $productsRepository;

    /**
     * @var App
     */
    private $app;

    /**
     * ProductsAddingController constructor.
     *
     * @param ProductsRepositoryInterface $productsRepository
     * @param App $app
     */
    public function __construct(ProductsRepositoryInterface $productsRepository, App $app)
    {
        $this->productsRepository = $productsRepository;
        $this->app = $app;
    }

    public function store(StoreOrUpdateProduct $request)
    {
        $product = $this->createProductFromRequest($request->validated());

        $this->productsRepository
            ->addNewProduct($product);

        return response()->json(null, 201);
    }

    public function update(StoreOrUpdateProduct $request, $id)
    {
        $product = $this->createProductFromRequest($request->validated());

        $this->productsRepository->updateProduct($id, $product);

        return response()->json(null, 204);
    }

    public function destroy($id)
    {
        $this->productsRepository->removeProduct($id);

        return response()->json(null, 204);
    }

    /**
     * Creates Product object from data provided in the request.
     *
     * @param array $data
     *
     * @return ProductInterface
     */
    private function createProductFromRequest(array $data)
    {
        /** @var ProductInterface $product */
        $product = $this->app->make(ProductInterface::class);
        $product->setName($data['name'])
            ->setAmount($data['amount']);

        return $product;
    }
}
