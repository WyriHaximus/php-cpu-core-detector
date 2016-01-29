<?php

namespace WyriHaximus\CpuCoreDetector;

use WyriHaximus\CpuCoreDetector\Core\Affinity\Taskset;

class Resolver
{
    public static function resolve($address, $cmd = '')
    {
        return (new Taskset())->execute($address, $cmd);
    }
}
