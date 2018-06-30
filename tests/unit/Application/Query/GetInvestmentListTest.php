<?php

namespace CriptoControl\Tests\Unit\Application\Query;

use CriptoControl\Application\Query\GetInvestmentList;
use CriptoControl\Application\Query\InvestmentCollection;
use PHPUnit\Framework\TestCase;

class GetInvestmentListTest extends TestCase
{
    public function testShouldGetInvestmentListWhenBeCalled(): void
    {
        $sut = new GetInvestmentList();

        $investmentCollection = $sut->handle();

        $this->assertInstanceOf(InvestmentCollection::class, $investmentCollection);
    }
}
