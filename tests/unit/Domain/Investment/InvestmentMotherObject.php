<?php

namespace CriptoControl\Tests\Unit\Domain\Investment;

use CriptoControl\Domain\Investment\Investment;

class InvestmentMotherObject
{
    private const CODE = 'EUR';
    private const AMOUNT = 12345.12;

    public static function buildToFixed(array $attributes = []): Investment
    {
        $defaultAttributes = [
            'code' => self::CODE,
            'amount' => self::AMOUNT,
        ];

        $attributes = array_merge($defaultAttributes, $attributes);

        $constructorArgs = array_values(array_merge($defaultAttributes, $attributes));

        return new Investment(...$constructorArgs);
    }
}
