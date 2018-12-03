<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Count;

use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Core\Count\Nproc;

/**
 * @internal
 */
final class NprocTest extends AbstractCountTest
{
    protected function getStrategy()
    {
        return new Nproc($this->prophesize(LoopInterface::class)->reveal());
    }
}
