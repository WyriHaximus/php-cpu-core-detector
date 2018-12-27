<?php declare(strict_types=1);

use React\EventLoop\Factory;
use WyriHaximus\CpuCoreDetector\Detector;
use WyriHaximus\CpuCoreDetector\Resolver;

require \dirname(__DIR__) . \DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$loop = Factory::create();

Detector::detectAsync($loop)->then(function ($result): void {
    echo $result, \PHP_EOL;
    for ($i = 0; $i < $result; $i++) {
        Resolver::resolve($i, 'uptime')->then(function ($cmd): void {
            echo $cmd, \PHP_EOL;
        });
    }
});

$loop->run();
