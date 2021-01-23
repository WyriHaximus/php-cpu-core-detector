<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use WyriHaximus\CpuCoreDetector\Core\Affinity\CmdExe;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

final class CmdExeTest extends AbstractAffinityTest
{
    protected function getStrategy(): AffinityInterface
    {
        return new CmdExe();
    }
}
