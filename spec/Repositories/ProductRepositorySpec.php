<?php

namespace spec\MrPiatek\BlueServer\Repositories;


use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use MrPiatek\BlueServer\Exceptions\InvalidAmountException;
use MrPiatek\BlueServer\Interfaces\ProductsRepositoryInterface;
use MrPiatek\BlueServer\Models\Product;
use MrPiatek\BlueServer\Repositories\ProductRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductRepositorySpec extends ObjectBehavior
{
    private const PRODUCTS_IN_DATABASE = [
        ['id' => 1, 'name' => 'Laptop', 'amount' => 5],
        ['id' => 2, 'name' => 'PC', 'amount' => 3],
        ['id' => 3, 'name' => 'MacBook', 'amount' => 0],
        ['id' => 4, 'name' => 'iPhone', 'amount' => 7],
    ];

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
        $productsInStock = array_filter(self::PRODUCTS_IN_DATABASE, function ($product) {
            return $product['amount'] > 0;
        });

        $productModel->newQuery()->shouldBeCalled();

        $query->where('amount', '>', 0)
            ->shouldBeCalled()
            ->willReturn($query);
        $query->get()
            ->shouldBeCalled()
            ->willReturn(new Collection($productsInStock));

        $this->getProductsInStock()->shouldBeLike(new Collection($productsInStock));
    }

    function it_gets_products_out_of_stock(Product $productModel, Builder $query)
    {
        $productsOutOfStock = array_filter(self::PRODUCTS_IN_DATABASE, function ($product) {
            return $product['amount'] = 0;
        });

        $productModel->newQuery()->shouldBeCalled();

        $query->where('amount', '=', 0)
            ->shouldBeCalled()
            ->willReturn($query);
        $query->get()
            ->shouldBeCalled()
            ->willReturn(new Collection($productsOutOfStock));

        $this->getProductsOutOfStock()->shouldBeLike(new Collection($productsOutOfStock));
    }

    function it_gets_products_with_amount_over(Product $productModel, Builder $query)
    {
        $amountOverValue = 5;
        for ($i = 1; $i <= $amountOverValue; $i++) {
            $products = array_filter(self::PRODUCTS_IN_DATABASE, function ($product) use ($i) {
                return $product['amount'] > $i;
            });

            $productModel->newQuery()->shouldBeCalled();

            $query->where('amount', '>', $i)
                ->shouldBeCalled()
                ->willReturn($query);
            $query->get()
                ->shouldBeCalled()
                ->willReturn(new Collection($products));

            $this->getProductsWithAmountOver($i)
                ->shouldBeLike(new Collection($products));
        }
    }

    function it_throws_exception_on_invalid_amount()
    {
        $this->shouldThrow(InvalidAmountException::class)
            ->duringGetProductsWithAmountOver(-1);
    }

    function it_should_add_new_product(Product $productModel, Builder $query)
    {
        $newProduct = new Product([
            'name' => 'Gaming PC',
            'amount' => 3
        ]);

        $productModel->newQuery()->shouldBeCalled();

        $query->create($newProduct->toArray())->shouldBeCalled();

        $this->addNewProduct($newProduct);
    }

    function it_should_remove_product(Product $productModel, Builder $query)
    {
        $productIdToRemove = 2;

        $productModel->newQuery()->shouldBeCalled();

        $query->where('id', '=', $productIdToRemove)
            ->shouldBeCalled()
            ->willReturn($query);
        $query->delete()
            ->shouldBeCalled();

        $this->removeProduct($productIdToRemove);
    }

    function it_should_update_product(Product $productModel, Builder $query)
    {

        $productId = 3;
        $productToUpdate = new Product([
            'name' => 'New Laptop',
            'amount' => 0
        ]);

        $productModel->newQuery()->shouldBeCalled();

        $query->where('id', '=', $productId)
            ->shouldBeCalled()
            ->willReturn($query);
        $query->update([
            'name' => $productToUpdate->name,
            'amount' => $productToUpdate->amount
        ])
            ->shouldBeCalled();

        $this->updateProduct($productId, $productToUpdate);
    }
}
