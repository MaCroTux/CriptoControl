<?php

namespace CriptoControl\Tests\Unit\Application\Query;

use CriptoControl\Application\Query\GetExchangeForInvestmentHandler;
use CriptoControl\Domain\Exchange\CurrencyEnum;
use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Infrastructure\Persistence\InMemory\InMemoryExchangeReadRepository;
use CriptoControl\Tests\Unit\Domain\Investment\InvestmentMotherObject;
use PHPUnit\Framework\TestCase;

class GetExchangeForInvestmentHandlerTest extends TestCase
{
    /**
     * @dataProvider investmentProvider
     */
    public function testShouldReturnAmountExchangeWhenPassAnInvestment(
        Investment $investment,
        string $currencyCode,
        float $expectedAmount
    ): void {
        $exchangeRepository = new InMemoryExchangeReadRepository();
        $exchangeRepository->save(
            $investment,
            $currencyCode,
            $expectedAmount
        );

        $sut = new GetExchangeForInvestmentHandler(
            $exchangeRepository
        );

        $amount = $sut->handle($investment, $currencyCode);

        $this->assertSame(
            $expectedAmount * $investment->amount(),
            $amount
        );
    }

    public function investmentProvider(): array
    {
        return [
            [
                InvestmentMotherObject::random(),
                CurrencyEnum::EURCode(),
                12.34
            ],
            [
                InvestmentMotherObject::random(),
                CurrencyEnum::USDCode(),
                10.54
            ]
        ];
    }
}