<?php

namespace CriptoControl\Application\Query;

use CriptoControl\Domain\Investment\Investment;

class GetInvestmentWithCurrencyHandler
{
    /** @var InvestmentReadRepository */
    private $investmentReadRepository;

    public function __construct(InvestmentReadRepository $investmentReadRepository)
    {
        $this->investmentReadRepository = $investmentReadRepository;
    }

    public function handle(string $currency): Investment
    {
        return $this->investmentReadRepository->byCurrencyCode($currency);
    }
}
