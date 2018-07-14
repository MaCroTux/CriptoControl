<?php

namespace CriptoControl\Domain\Exchange;

use CriptoControl\Domain\Investment\Investment;

interface ExchangeReadRepository
{
    public function find(Investment $investment, string $currency): ExchangeAmount;
}