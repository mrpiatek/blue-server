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
     * @var int|null Product ID
     */
    private $id;

    /**
     * Product constructor.
     *
     * @param int|null $id
     * @param string $name Product's name
     * @param int $amount Amount of the product currently in stock
     */
    public function __construct(?int $id, string $name, int $amount)
    {
        $this->id = $id;
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'amount' => $this->getAmount(),
        ];
    }
}