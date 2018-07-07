<?php

namespace CriptoControl\Tests\Integration\Infrastructure\UserInterface;

use CriptoControl\Application\Query\GetInvestmentListHandler;
use CriptoControl\Infrastructure\Persistence\InMemory\InMemoryInvestmentReadRepository;
use CriptoControl\Infrastructure\UserInterface\Cli\InvestmentCommand;
use CriptoControl\Tests\Integration\Base\OutputSpy;
use CriptoControl\Tests\Unit\Domain\Investment\InvestmentMotherObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;

class InvestmentCommandTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();


    }

    public function testShouldResponseJsonWhenLaunchCommand(): void
    {
        $investmentRepository = $this->getInvestmentRepository();
        $investmentExpected   = $investmentRepository->all();

        $getInvestmentListHandler = new GetInvestmentListHandler($investmentRepository);

        /** @var InputInterface $input */
        $input  = $this->prophesize(InputInterface::class)->reveal();
        $output = new OutputSpy();

        $sut = new InvestmentCommand($getInvestmentListHandler);
        $sut->execute($input, $output);

        $this->assertEquals(json_encode($investmentExpected->toArray()), $output->data());
    }

    private function getInvestmentRepository(): InMemoryInvestmentReadRepository
    {
        $investmentReadRepository = new InMemoryInvestmentReadRepository();
        $investmentReadRepository->save(InvestmentMotherObject::buildToFixed());

        return $investmentReadRepository;
    }
}
