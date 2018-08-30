<?php

namespace CriptoControl\Infrastructure\UserInterface\Cli;

use CriptoControl\Application\Query\GetInvestmentByFiatHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetInvestmentByFiatCommand extends Command
{
    /** @var GetInvestmentByFiatHandler */
    private $getInvestmentByFiatHandler;

    protected function configure()
    {
        $this
            ->setName('command:getInvestmentByFiat')
            ->setDescription('Investment list in fiat value')
            ->addArgument('currencyCode', InputArgument::REQUIRED, 'Currency code');
    }

    public function __construct(GetInvestmentByFiatHandler $getInvestmentByFiatHandler)
    {
        parent::__construct();

        $this->getInvestmentByFiatHandler = $getInvestmentByFiatHandler;
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $currencyCode = $input->getArgument('currencyCode');

        $list = $this->getInvestmentByFiatHandler->handle($currencyCode);

        $output->writeln(json_encode($list));
    }
}