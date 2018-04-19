<?php

namespace MrPiatek\BlueServer\Interfaces;

interface ProductInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getAmount(): int;

    public function setName(string $name): ProductInterface;

    public function setAmount(int $amount): ProductInterface;

    public function toArray();
}