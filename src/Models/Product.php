<?php

namespace MrPiatek\BlueServer\Models;

use Illuminate\Database\Eloquent\Model;
use MrPiatek\BlueServer\Interfaces\ProductInterface;

class Product extends Model implements ProductInterface
{
    public $timestamps = false;

    protected $fillable = ['name', 'amount'];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setName(string $name): ProductInterface
    {
        $this->name = $name;
        return $this;
    }

    public function setAmount(int $amount): ProductInterface
    {
        $this->amount = $amount;
        return $this;
    }
}
