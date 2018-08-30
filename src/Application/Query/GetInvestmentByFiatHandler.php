<?php

namespace CriptoControl\Application\Query;

use CriptoControl\Domain\Investment\Investment;

class GetInvestmentByFiatHandler
{
    /** @var GetInvestmentListHandler */
    private $getInvestmentListHandler;
    /** @var GetExchangeForInvestmentHandler */
    private $getExchangeForInvestmentHandler;

    private $fiatCurrencies = [
        'USD',
        'EUR'
    ];

    public function __construct(
        GetInvestmentListHandler $getInvestmentListHandler,
        GetExchangeForInvestmentHandler $getExchangeForInvestmentHandler
    ) {
        $this->getInvestmentListHandler = $getInvestmentListHandler;
        $this->getExchangeForInvestmentHandler = $getExchangeForInvestmentHandler;
    }

    public function handle(string $currencyFiatCode): array
    {
        $investmentList = $this->getInvestmentListHandler->handle();
        $getExchangeForInvestmentHandler = $this->getExchangeForInvestmentHandler;
        $investmentInFiatValue = [];

        /** @var Investment $investment */
        foreach ($investmentList as $investment) {

            if ($this->isFiatCurrency($investment)) {
                $investmentInFiatValue[$investment->code()] = [
                    $investment->code() => $investment->amount()
                ];
                continue;
            }

            $fiatAmount = $getExchangeForInvestmentHandler->handle($investment, $currencyFiatCode);
            $investmentInFiatValue[$investment->code()] = [
                $investment->code() => $investment->amount(),
                $currencyFiatCode   => $fiatAmount,
            ];

        }

        return $investmentInFiatValue;
    }

    public function isFiatCurrency(Investment $investment): bool
    {
        return in_array($investment->code(), $this->fiatCurrencies);
    }
}