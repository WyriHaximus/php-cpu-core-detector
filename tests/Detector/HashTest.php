<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Detector;

use Phake;
use WyriHaximus\CpuCoreDetector\Detector\Hash;
use WyriHaximus\CpuCoreDetector\Tests\AbstractStrategyTest;

class HashTest extends AbstractStrategyTest
{
    protected function getStrategy()
    {
        return new Hash(Phake::mock('React\EventLoop\LoopInterface'));
    }

}
