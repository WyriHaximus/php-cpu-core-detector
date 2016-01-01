<?php

use React\EventLoop\Factory;
use WyriHaximus\CpuCoreDetector\Detector;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';


$loop = Factory::create();

Detector::detectAsync($loop)->then(function ($result) {
    var_export($result);
});

$loop->run();
