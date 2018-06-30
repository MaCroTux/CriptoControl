<?php

namespace CriptoControl\Tests\Unit\Domain\Investment;

use CriptoControl\Domain\Investment\Investment;

class InvestmentMotherObject
{
    public const CODE   = 'EUR';
    public const AMOUNT = 12345.12;

    public static function buildToFixed(array $attributes = []): Investment
    {
        $defaultAttributes = [
            'id'     => '',
            'code'   => self::CODE,
            'amount' => self::AMOUNT,
        ];

        $attributes = array_merge($defaultAttributes, $attributes);

        $constructorArgs = array_values(array_merge($defaultAttributes, $attributes));

        return new Investment(...$constructorArgs);
    }
}
