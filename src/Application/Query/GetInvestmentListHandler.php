<?php

namespace CriptoControl\Application\Query;

use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentCollection;

class GetInvestmentListHandler
{
    public function handle(): InvestmentCollection
    {
        return new InvestmentCollection(
            [
                Investment::build('BTC', '6700.00')
            ],
            Investment::class
        );
    }
}
