<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Count;

use Phake;
use WyriHaximus\CpuCoreDetector\Core\Count\WindowsEcho;

class WindowsEchoTest extends AbstractCountTest
{
    protected function getStrategy()
    {
        return new WindowsEcho(Phake::mock('React\EventLoop\LoopInterface'));
    }

}
