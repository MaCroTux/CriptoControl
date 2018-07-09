<?php

namespace CriptoControl\Infrastructure\UserInterface\Cli;

use CriptoControl\Application\Query\GetInvestmentListHandler;
use CriptoControl\Application\Query\GetInvestmentWithCurrencyHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InvestmentByCurrencyCommand extends Command
{
    /** @var GetInvestmentWithCurrencyHandler */
    private $getInvestmentWithCurrencyHandler;

    protected function configure()
    {
        $this
            ->setName('command:getInvestment')
            ->setDescription('Investment for currency code')
            ->addArgument('code', InputArgument::REQUIRED, 'Currency code');
    }

    public function __construct(GetInvestmentWithCurrencyHandler $getInvestmentWithCurrencyHandler)
    {
        parent::__construct();

        $this->getInvestmentWithCurrencyHandler = $getInvestmentWithCurrencyHandler;
    }

    /**
     * @throws \Collections\Exceptions\InvalidArgumentException
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $code                 = $input->getArgument('code');
        $investmentCollection = $this->getInvestmentWithCurrencyHandler->handle($code);

        $output->writeln(
            json_encode(
                [
                    'id'     => $investmentCollection->id(),
                    'code'   => $investmentCollection->code(),
                    'amount' => $investmentCollection->amount(),
                ]
            )
        );
    }
}
