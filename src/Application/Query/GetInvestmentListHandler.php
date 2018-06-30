<?php

namespace CriptoControl\Application\Query;

use CriptoControl\Domain\Investment\InvestmentCollection;

class GetInvestmentListHandler
{
    /** @var InvestmentReadRepository */
    private $investmentReadRepository;

    public function __construct(InvestmentReadRepository $investmentReadRepository)
    {
        $this->investmentReadRepository = $investmentReadRepository;
    }

    public function handle(): InvestmentCollection
    {
        return $this->investmentReadRepository->all();
    }
}
