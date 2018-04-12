<?php

namespace MrPiatek\BlueServer\Entities;


class Product
{
    /**
     * @var string Product's name
     */
    private $name;

    /**
     * @var int Amount of the product currently in stock
     */
    private $amount;

    /**
     * Product constructor.
     *
     * @param string $name Product's name
     * @param int $amount Amount of the product currently in stock
     */
    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}