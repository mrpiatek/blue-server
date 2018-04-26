<?php

namespace spec\MrPiatek\BlueServer\Models;

use MrPiatek\BlueServer\Models\Product;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Product::class);
    }

    function it_should_store_name_and_allow_chain_calls()
    {
        $name = 'Product X';
        $this->setName($name)->getName()->shouldReturn($name);
    }

    function it_should_store_amount_and_allow_chain_calls()
    {
        $amount = 9999;
        $this->setName($amount)->getName()->shouldBeLike($amount);
    }
}
