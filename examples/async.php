<?php

use React\EventLoop\Factory;
use WyriHaximus\CpuCoreDetector\Detector;
use WyriHaximus\CpuCoreDetector\Resolver;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';


$loop = Factory::create();

Detector::detectAsync($loop)->done(function ($result) use ($loop) {
    echo $result, PHP_EOL;
    for ($i = 0; $i < $result; $i++) {
        $promises[] = Resolver::resolve($i, 'uptime')->then(function ($cmd) {
            echo $cmd, PHP_EOL;
        });
    }

    \React\Promise\all($promises)->done(function () use ($loop) {
        $loop->stop();
    });
});

$loop->run();
