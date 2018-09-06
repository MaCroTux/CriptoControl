<?php

namespace CriptoControl\Infrastructure\UserInterface\Cli;

use CriptoControl\Application\Query\GetInvestmentByAddressHandler;
use CriptoControl\Domain\Exceptions\AddressNotFound;
use CriptoControl\Infrastructure\Persistence\AddressInfoRepositoryFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BalanceByAddressWalletCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('command:getBalanceByAddressWallet')
            ->setDescription('Get balance from wallet address')
            ->addArgument('code', InputArgument::REQUIRED, 'Currency code')
            ->addArgument('address', InputArgument::REQUIRED, 'Address');
    }

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws AddressNotFound
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $code                 = $input->getArgument('code');
        $address              = $input->getArgument('address');

        $getInvestmentByAddressHandler = new GetInvestmentByAddressHandler(
            AddressInfoRepositoryFactory::build($code)
        );

        $balance = $getInvestmentByAddressHandler->handle($address);

        $output->writeln(
            json_encode(
                [
                    'balance' => $balance,
                ]
            )
        );
    }
}
