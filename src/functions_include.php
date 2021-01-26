<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use function function_exists;

if (! function_exists('WyriHaximus\CpuCoreDetector\getDefaultCollections(')) {
    require __DIR__ . '/functions.php';
}
