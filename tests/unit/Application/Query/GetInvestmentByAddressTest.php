<?php

namespace CriptoControl\Tests\Unit\Application\Query;

use CriptoControl\Application\Query\GetInvestmentByAddressHandler;
use PHPStan\Testing\TestCase;

class GetInvestmentByAddressTest extends TestCase
{
    private const BTC_TYPE = 'BTC';
    private const BTC_ADDRESS = '1MNPi6xg6icAW1W4XfAtYKBDyZTL372dg4';

    public function testGetAmountWhenGiveAddress(): void
    {
        $sut = new GetInvestmentByAddressHandler();
        $amount = $sut->handle(self::BTC_TYPE, self::BTC_ADDRESS);

        $this->assertNotNull($amount);
    }
}