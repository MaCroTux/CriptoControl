<?php

namespace CriptoControl\Infrastructure\Persistence\InMemory;

use CriptoControl\Domain\Exchange\ExchangeAmount;
use CriptoControl\Domain\Exchange\ExchangeReadRepository;
use CriptoControl\Domain\Investment\Investment;

class InMemoryExchangeReadRepository implements ExchangeReadRepository
{
    /** @var ExchangeAmount[] */
    private $exchangeAmount = [];

    public function find(Investment $investment, string $currency): ExchangeAmount
    {
        return $this->exchangeAmount[$currency];
    }

    public function save(Investment $investment, string $currency, string $amount)
    {
        return $this->exchangeAmount[$currency] = new ExchangeAmount($investment, $currency, $amount);
    }
}