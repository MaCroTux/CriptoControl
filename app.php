<?php

require __DIR__ . '/vendor/autoload.php';

const ENVIRONMENT_DEFAULT = 'dev';

use CriptoControl\Infrastructure\UserInterface\Cli\InvestmentCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();

$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('services.yaml');

$application = new Application();
$application->add(new InvestmentCommand($containerBuilder->get('GetInvestmentListHandler')));
$application->run();
