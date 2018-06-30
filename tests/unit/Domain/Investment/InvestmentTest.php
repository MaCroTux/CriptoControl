<?php

namespace CriptoControl\Tests\Domain\Investment;

use CriptoControl\Domain\Investment\Investment;
use PHPUnit\Framework\TestCase;

class InvestmentTest extends TestCase
{
    private const ID     = '654-654-654-645';
    private const CODE   = 'USD';
    private const AMOUNT = 201512.00;

    /** @var Investment */
    private $sut;

    protected function setUp()
    {
        parent::setUp();

        $this->sut = new Investment(self::ID, self::CODE, self::AMOUNT);
    }

    public function testShouldReturnIdWhenGetterCalled(): void
    {
        $this->assertSame(self::ID, $this->sut->id());
    }

    public function testShouldReturnCodeWhenGetterCalled(): void
    {
        $this->assertSame(self::CODE, $this->sut->code());
    }

    public function testShouldReturnAmountWhenGetterCalled(): void
    {
        $this->assertSame(self::AMOUNT, $this->sut->amount());
    }
}
