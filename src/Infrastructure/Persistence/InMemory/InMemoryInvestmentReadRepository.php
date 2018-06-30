<?php

namespace CriptoControl\Infrastructure\Persistence\InMemory;

use CriptoControl\Application\Query\InvestmentReadRepository;
use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentCollection;
use CriptoControl\Domain\Investment\InvestmentRepository;

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
}
