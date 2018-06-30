<?php

namespace CriptoControl\Domain\Investment;

interface InvestmentRepository
{
    public function save(Investment $investment): void;
}
