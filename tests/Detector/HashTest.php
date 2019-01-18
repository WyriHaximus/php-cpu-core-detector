<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Detector;

use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Detector\Hash;
use WyriHaximus\CpuCoreDetector\Tests\AbstractStrategyTest;

/**
 * @internal
 */
class HashTest extends AbstractStrategyTest
{
    protected function getStrategy()
    {
        return new Hash($this->prophesize(LoopInterface::class)->reveal());
    }
}
