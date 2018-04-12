<?php

namespace MrPiatek\BlueServer\Exceptions;


class InvalidAmountException extends \Exception
{

    /**
     * InvalidAmountException constructor.
     */
    public function __construct()
    {
        parent::__construct('Amount must be greater or equal than 0.');
    }
}