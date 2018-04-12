<?php

namespace MrPiatek\BlueServer\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use MrPiatek\BlueServer\Entities\Product;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;

class ProductsUpdatingController extends BaseController
{
    use ValidatesRequests;
    /**
     * @var ProductsRepositoryInterface
     */
    private $productsRepository;

    /**
     * ProductsUpdatingController constructor.
     *
     * @param ProductsRepositoryInterface $productsRepository
     */
    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function updateProduct(int $productId, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|min:1|unique:products,name',
            'amount' => 'required|int|min:0'
        ]);

        $this->productsRepository
            ->updateProduct(new Product(
                $productId,
                $request->input('name'),
                $request->input('amount')
            ));

        return response()->json(null, 204);
    }

    public function removeProduct(int $productId)
    {
        $this->productsRepository
            ->removeProduct($productId);

        return response()->json(null, 204);
    }
}
