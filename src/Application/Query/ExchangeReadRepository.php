<?php

namespace CriptoControl\Application\Query;

use CriptoControl\Domain\Exchange\ExchangeAmount;
use CriptoControl\Domain\Investment\Investment;

interface ExchangeReadRepository
{
    public function find(Investment $investment, string $currency): ExchangeAmount;
}