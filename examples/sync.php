<?php

use WyriHaximus\CpuCoreDetector\Detector;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

echo Detector::detect(), PHP_EOL;
