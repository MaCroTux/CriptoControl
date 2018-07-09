<?php

namespace CriptoControl\Application\Query;

use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentCollection;

interface InvestmentReadRepository
{
    public function all(): InvestmentCollection;

    public function byCurrencyCode(string $currency): Investment;
}
