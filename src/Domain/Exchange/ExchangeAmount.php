<?php

namespace CriptoControl\Domain\Exchange;

use CriptoControl\Domain\Investment\Investment;

class ExchangeAmount
{
    /** @var Investment */
    private $investment;
    /** @var string */
    private $code;
    /** @var float */
    private $amount;

    public function __construct(Investment $investment, string $code, float $amount)
    {
        $this->investment = $investment;
        $this->code = $code;
        $this->amount = $amount;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}