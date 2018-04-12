<?php

namespace spec\MrPiatek\BlueServer\Repositories;


use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;
use MrPiatek\BlueServer\Models\Product;
use MrPiatek\BlueServer\Entities\Product as ProductEntity;
use MrPiatek\BlueServer\Repositories\ProductRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductRepositorySpec extends ObjectBehavior
{
    function let(App $app, Product $productModel, Builder $query)
    {
        $productModel->newQuery()->willReturn($query);
        $app->make(Product::class)->willReturn($productModel);
        $this->beConstructedWith($app);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductRepository::class);
    }

    function it_implements_proper_interface()
    {
        $this->shouldBeAnInstanceOf(ProductsRepositoryInterface::class);
    }

    function it_gets_products_in_stock(Product $productModel, Builder $query)
    {
        $productsInDatabase = [
            ['id' => 1, 'name' => 'Laptop', 'amount' => 5],
            ['id' => 2, 'name' => 'PC', 'amount' => 3],
            ['id' => 3, 'name' => 'MacBook', 'amount' => 0],
        ];

        $productsInStock = array_filter($productsInDatabase, function ($product) {
            return $product['amount'] > 0;
        });

        $productModel->newQuery()->shouldBeCalled();

        $query->where('amount', '>', 0)
            ->shouldBeCalled()
            ->willReturn($query);
        $query->get()
            ->shouldBeCalled()
            ->willReturn(new Collection($productsInStock));

        $expectedResult = [];
        foreach ($productsInStock as $product) {
            $expectedResult[] = new ProductEntity(
                $product['id'],
                $product['name'],
                $product['amount']
            );
        }

        $this->getProductsInStock()->shouldBeLike($expectedResult);
    }
}
