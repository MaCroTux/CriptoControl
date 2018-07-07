<?php

namespace CriptoControl\Tests\Unit\Domain\Investment;

use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentCollection;
use PHPUnit\Framework\TestCase;

class InvestmentCollectionTest extends TestCase
{
    public function testShouldCheckedCollectionWhenIsInstantiate()
    {
        $sut = new InvestmentCollection([InvestmentMotherObject::buildToFixed()], Investment::class);

        $this->assertInstanceOf(InvestmentCollection::class, $sut);
        $this->assertInstanceOf(Investment::class, $sut->first());
    }
}
