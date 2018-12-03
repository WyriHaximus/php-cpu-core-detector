<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use WyriHaximus\CpuCoreDetector\Core\Affinity\CmdExe;

/**
 * @internal
 */
class CmdExeTest extends AbstractAffinityTest
{
    protected function getStrategy()
    {
        return new CmdExe();
    }
}
