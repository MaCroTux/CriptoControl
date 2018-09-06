<?php

require __DIR__ . '/vendor/autoload.php';

const ENVIRONMENT_DEFAULT = 'dev';

use CriptoControl\Infrastructure\UserInterface\Cli\BalanceByAddressWalletCommand;
use CriptoControl\Infrastructure\UserInterface\Cli\ExchangeByCurrencyCommand;
use CriptoControl\Infrastructure\UserInterface\Cli\GetInvestmentByFiatCommand;
use CriptoControl\Infrastructure\UserInterface\Cli\InvestmentByCurrencyCommand;
use CriptoControl\Infrastructure\UserInterface\Cli\InvestmentCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();

$dotenv = new Dotenv\Dotenv(__DIR__, '.env.' . ENVIRONMENT_DEFAULT);
$dotenv->load();

$containerBuilder->setParameter('HitBTCApiKey', getenv('HitBTCApiKey'));
$containerBuilder->setParameter('HitBTCSecret', getenv('HitBTCSecret'));
$containerBuilder->setParameter('HitBTCModeDemo', FALSE);
$containerBuilder->setParameter('CriptosToFiat', 'https://api.cryptonator.com/api/ticker/');
$containerBuilder->setParameter('CoinMarketUrl', 'https://pro-api.coinmarketcap.com/v1/');
$containerBuilder->setParameter('CoinMarketApiKey', getenv('CoinMarketApiKey'));

$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('services.yaml');

$application = new Application();
$application->add(new InvestmentCommand($containerBuilder->get('GetInvestmentListHandler')));
$application->add(new InvestmentByCurrencyCommand($containerBuilder->get('GetInvestmentWithCurrencyHandler')));
$application->add(new ExchangeByCurrencyCommand($containerBuilder->get('GetExchangeForInvestmentHandler')));
$application->add(new GetInvestmentByFiatCommand($containerBuilder->get('GetInvestmentByFiatHandler')));
$application->add(new BalanceByAddressWalletCommand());

$application->run();
