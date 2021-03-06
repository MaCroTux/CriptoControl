<?php

namespace CriptoControl\Infrastructure\Persistence\InMemory;

use CriptoControl\Application\Query\InvestmentReadRepository;
use CriptoControl\Domain\Exceptions\InvestmentNotFound;
use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentCollection;
use CriptoControl\Domain\Investment\InvestmentRepository;
use CriptoControl\Tests\Unit\Domain\Investment\InvestmentMotherObject;

class InMemoryInvestmentReadRepository implements InvestmentReadRepository, InvestmentRepository
{
    private $investments = [];

    public function all(): InvestmentCollection
    {
        return new InvestmentCollection($this->investments, Investment::class);
    }

    public function save(Investment $investment): void
    {
        $this->investments[$investment->id()] = $investment;
    }

    /**
     * @throws InvestmentNotFound
     */
    public function byCurrencyCode(string $currency): Investment
    {
        if (!isset($this->investments[$currency])) {
            throw new InvestmentNotFound($currency);
        }

        $this->investments[$currency];
    }
}
