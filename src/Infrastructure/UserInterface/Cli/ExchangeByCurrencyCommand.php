<?php

namespace CriptoControl\Infrastructure\UserInterface\Cli;

use CriptoControl\Application\Query\GetExchangeForInvestmentHandler;
use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentId;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExchangeByCurrencyCommand extends Command
{
    /** @var GetExchangeForInvestmentHandler */
    private $getExchangeForInvestmentHandler;

    protected function configure()
    {
        $this
            ->setName('command:getExchange')
            ->setDescription('Exchange cripto')
            ->addArgument('criptoCode', InputArgument::REQUIRED, 'Cripto Currency code')
            ->addArgument('amount', InputArgument::REQUIRED, 'Amount')
            ->addArgument('currencyCode', InputArgument::REQUIRED, 'Currency code');
    }

    public function __construct(GetExchangeForInvestmentHandler $getExchangeForInvestmentHandler)
    {
        parent::__construct();

        $this->getExchangeForInvestmentHandler = $getExchangeForInvestmentHandler;
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $criptoCode   = $input->getArgument('criptoCode');
        $amount       = $input->getArgument('amount');
        $currencyCode = $input->getArgument('currencyCode');

        $investment = Investment::build(
            InvestmentId::create(),
            $criptoCode,
            $amount
        );
        $amount = $this->getExchangeForInvestmentHandler->handle(
            $investment,
            $currencyCode
        );

        $output->writeln(json_encode(['amount' => $amount]));
    }
}
