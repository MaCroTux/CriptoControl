<?php

namespace CriptoControl\Tests\Unit\Domain\Exchange;

use CriptoControl\Domain\Exchange\CurrencyEnum;
use PHPStan\Testing\TestCase;

class CurrencyEnumTest extends TestCase
{
    public function testShouldNoEmptyReturnWhenBeEURCode()
    {
        $this->assertNotEmpty(CurrencyEnum::EURCode());
    }

    public function testShouldNoEmptyReturnWhenBeUSDCode()
    {
        $this->assertNotEmpty(CurrencyEnum::USDCode());
    }
}