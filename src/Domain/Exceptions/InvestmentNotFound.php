<?php

namespace CriptoControl\Domain\Exceptions;

use Exception;

class InvestmentNotFound extends Exception
{
    private const MESSAGE = 'Cripto currency $s not found.';

    public function __construct(string $currency)
    {
        parent::__construct(sprintf(self::MESSAGE, $currency), 0);
    }
}
