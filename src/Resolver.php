<?php

use WyriHaximus\CpuCoreDetector\Core\Affinity\Taskset;

class Resolver
{
    public static function resolve($address)
    {
        return (new Taskset())->execute($address);
    }
}
