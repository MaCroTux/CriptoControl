<?php

namespace CriptoControl\Tests\Domain\Investment;

use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentCollection;
use CriptoControl\Tests\Unit\Domain\Investment\InvestmentMotherObject;
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
