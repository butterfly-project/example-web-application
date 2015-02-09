<?php

use Butterfly\Component\DI\Container;
use Butterfly\Component\Packages\PackagesConfig;

$rootDir = realpath(__DIR__ . '/..');

require_once $rootDir . '/vendor/autoload.php';

$additionalConfigPaths = array(
    $rootDir . '/config/local.yml',
);

$config    = PackagesConfig::buildForComposer($rootDir, $additionalConfigPaths);
$container = new Container($config);
$container->get('bfy_app.request_response')->run();
