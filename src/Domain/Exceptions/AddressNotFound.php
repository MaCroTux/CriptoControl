<?php

namespace CriptoControl\Domain\Exceptions;

use Exception;

class AddressNotFound extends Exception
{
    private const MESSAGE = 'Address type %s not found.';

    public function __construct(string $type)
    {
        parent::__construct(sprintf(self::MESSAGE, $type), 0);
    }
}
