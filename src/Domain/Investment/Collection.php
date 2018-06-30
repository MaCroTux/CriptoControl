<?php

namespace CriptoControl\Domain\Investment;

use Collections\Collection as VendorCollection;

class Collection extends VendorCollection
{
    public function __construct(array $items = [], string $type = 'array')
    {
        parent::__construct($type, $items);
    }
}
