<?php

namespace CriptoControl\Domain\Exceptions;

use Exception;

class ExchangeException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}