<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use Phake;
use WyriHaximus\CpuCoreDetector\Core\Affinity\Taskset;
use WyriHaximus\CpuCoreDetector\Core\Count\Nproc;

class TasksetTest extends AbstractAffinityTest
{
    protected function getStrategy()
    {
        return new Taskset(Phake::mock('React\EventLoop\LoopInterface'));
    }

}
