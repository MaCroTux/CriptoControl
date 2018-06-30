<?php

namespace CriptoControl\Application\Query;

class GetInvestmentList
{
    public function handle(): InvestmentCollection
    {
        return new InvestmentCollection([]);
    }
}
