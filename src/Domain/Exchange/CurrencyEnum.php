<?php

namespace CriptoControl\Domain\Exchange;

class CurrencyEnum
{
    private const EUR_CODE = 'EUR';
    private const USD_CODE = 'USD';

    public static function EURCode(): string
    {
        return self::EUR_CODE;
    }

    public static function USDCode(): string
    {
        return self::USD_CODE;
    }
}