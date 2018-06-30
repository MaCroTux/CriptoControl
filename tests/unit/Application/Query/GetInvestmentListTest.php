<?php

namespace CriptoControl\Tests\Unit\Application\Query;

use CriptoControl\Application\Query\GetInvestmentListHandler;
use CriptoControl\Domain\Investment\Investment;
use PHPUnit\Framework\TestCase;

class GetInvestmentListTest extends TestCase
{
    public function testShouldGetInvestmentListWhenBeCalled(): void
    {
        $sut = new GetInvestmentListHandler();

        $investmentCollection = $sut->handle();
        /** @var Investment $investment */
        $investment = $investmentCollection->first();

        $this->assertSame('BTC', $investment->code());
        $this->assertSame(6700.00, $investment->amount());
    }
}
