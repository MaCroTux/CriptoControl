<?php

namespace CriptoControl\Tests\Unit\Application\Query;

use CriptoControl\Application\Query\GetInvestmentList;
use PHPUnit\Framework\TestCase;

class GetInvestmentListTest extends TestCase
{
    public function testShouldGetInvestmentListWhenBeCalled(): void
    {
        $sut = new GetInvestmentList();

        $result = $sut->handle();

        $this->assertInternalType('array', $result);
    }
}
