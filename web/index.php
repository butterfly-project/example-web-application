<?php

use Butterfly\Component\DI\Compiler\Dumper;
use Butterfly\Component\DI\Container;
use Butterfly\Component\Packages\PackagesConfig;

$rootDir = realpath(__DIR__ . '/..');

require_once $rootDir . '/vendor/autoload.php';

$configPath = $rootDir . '/var/config.php';
$config     = Dumper::getConfig($configPath);

if (null === $config) {
    $additionalConfigPaths = array(
        $rootDir . '/config/local.yml',
    );
    $config = PackagesConfig::buildForComposer($rootDir, $additionalConfigPaths);
    Dumper::dump($config, $configPath);
}

$container = new Container($config);
$container->get('bfy_app.request_response')->run();
