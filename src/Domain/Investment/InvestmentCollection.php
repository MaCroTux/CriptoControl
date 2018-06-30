<?php

namespace CriptoControl\Domain\Investment;

class InvestmentCollection extends Collection
{
    public function toArray()
    {
        return array_map(function (Investment $investment) {
            return [
                'code'   => $investment->code(),
                'amount' => $investment->amount(),
            ];
        }, $this->items);
    }
}
