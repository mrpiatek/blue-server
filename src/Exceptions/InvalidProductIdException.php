<?php

namespace MrPiatek\BlueServer\Exceptions;


class InvalidProductIdException extends \Exception
{

    /**
     * InvalidProductIdException constructor.
     */
    public function __construct()
    {
        parent::__construct('Product with given ID does not exist.');
    }
}