<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Count;

use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Core\Count\WindowsEcho;

/**
 * @internal
 */
class WindowsEchoTest extends AbstractCountTest
{
    protected function getStrategy()
    {
        return new WindowsEcho($this->prophesize(LoopInterface::class)->reveal());
    }
}
