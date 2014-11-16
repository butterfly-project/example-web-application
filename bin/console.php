<?php

use Butterfly\Component\DI\Container;
use Butterfly\Component\Packages\ExtendedDiConfig;

$rootDir = realpath(__DIR__ . '/..');
require_once $rootDir . '/vendor/autoload.php';

$output = $rootDir . '/var/consoleconfig.php';
$additionalConfigPaths = array(
    $rootDir . '/config/local.yml',
);

ExtendedDiConfig::buildForComposer($rootDir, $output, $additionalConfigPaths);

$container = new Container(require $output);
$container->get('bfy_app.sf2_console')->run();
