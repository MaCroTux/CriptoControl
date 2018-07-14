<?php

namespace CriptoControl\Application\Query;

use CriptoControl\Domain\Exchange\ExchangeAmount;
use CriptoControl\Domain\Exchange\ExchangeReadRepository;
use CriptoControl\Domain\Investment\Investment;

class GetExchangeForInvestmentHandler
{
    /** @var ExchangeReadRepository */
    private $exchangeReadRepository;

    public function __construct(ExchangeReadRepository $exchangeReadRepository)
    {
        $this->exchangeReadRepository = $exchangeReadRepository;
    }

    public function handle(Investment $investment, string $currencyCode): float
    {
        /** @var ExchangeAmount $exchangeAmount */
        $exchangeAmount = $this->exchangeReadRepository->find($investment, $currencyCode);

        return $exchangeAmount->amount() * $investment->amount();
    }
}