<?php

namespace CriptoControl\Tests\Unit\Application\Query;

use CriptoControl\Application\Query\GetInvestmentListHandler;
use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Infrastructure\Persistence\InMemory\InMemoryInvestmentReadRepository;
use CriptoControl\Tests\Unit\Domain\Investment\InvestmentMotherObject;
use PHPUnit\Framework\TestCase;

class GetInvestmentListHandlerTest extends TestCase
{
    public function testShouldGetInvestmentListWhenBeCalled(): void
    {
        $investmentReadRepository = new InMemoryInvestmentReadRepository();

        $investmentReadRepository->save(InvestmentMotherObject::buildToFixed());

        $sut = new GetInvestmentListHandler(
            $investmentReadRepository
        );

        $investmentCollection = $sut->handle();
        /** @var Investment $investment */
        $investment = $investmentCollection->first();

        $this->assertSame(InvestmentMotherObject::CODE, $investment->code());
        $this->assertSame(InvestmentMotherObject::AMOUNT, $investment->amount());
    }
}
