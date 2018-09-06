<?php

namespace CriptoControl\Infrastructure\Persistence;

use CriptoControl\Application\Query\AddressInfoRepository;

class BTCAddressInfoRepository implements AddressInfoRepository
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function balance($address): int
    {
        return 1;
    }
}