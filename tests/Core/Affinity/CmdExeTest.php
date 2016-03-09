<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use Phake;
use WyriHaximus\CpuCoreDetector\Core\Affinity\CmdExe;

class CmdExeTest extends AbstractAffinityTest
{
    protected function getStrategy()
    {
        return new CmdExe(Phake::mock('React\EventLoop\LoopInterface'));
    }

}
