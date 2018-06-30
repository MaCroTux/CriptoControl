<?php

namespace CriptoControl\Infrastructure\UserInterface\Cli;

use CriptoControl\Application\Query\GetInvestmentListHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InvestmentCommand extends Command
{
    /** @var GetInvestmentListHandler */
    private $getInvestmentListHandler;

    protected function configure()
    {
        $this
            ->setName('command:getInvestmentList')
            ->setDescription('Investment list');
    }

    public function __construct(GetInvestmentListHandler $commandQueryHandler)
    {
        parent::__construct();

        $this->getInvestmentListHandler = $commandQueryHandler;
    }

    /**
     * @throws \Collections\Exceptions\InvalidArgumentException
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $investmentCollection = $this->getInvestmentListHandler->handle();

        $output->writeln(json_encode($investmentCollection->toArray()));
    }
}
