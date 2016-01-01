<?php

use WyriHaximus\CpuCoreDetector\Detector;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

var_export(Detector::detect());
