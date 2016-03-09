<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Count;

use Phake;
use WyriHaximus\CpuCoreDetector\Core\Count\Nproc;

class NprocTest extends AbstractCountTest
{
    protected function getStrategy()
    {
        return new Nproc(Phake::mock('React\EventLoop\LoopInterface'));
    }

}
