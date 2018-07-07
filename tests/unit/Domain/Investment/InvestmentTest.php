<?php

namespace CriptoControl\Tests\Unit\Domain\Investment;

use CriptoControl\Domain\Investment\Investment;
use PHPUnit\Framework\TestCase;

class InvestmentTest extends TestCase
{
    private const ID     = 'b4e13af7-0aa6-4a15-b871-eed7dba3fc9a';
    private const CODE   = 'USD';
    private const AMOUNT = 201512.00;

    /** @var Investment */
    private $sut;

    protected function setUp()
    {
        parent::setUp();

        $this->sut = Investment::build(self::ID, self::CODE, self::AMOUNT);
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
