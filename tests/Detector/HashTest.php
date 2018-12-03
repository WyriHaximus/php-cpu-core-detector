<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Detector;

use WyriHaximus\CpuCoreDetector\Detector\Hash;
use WyriHaximus\CpuCoreDetector\Tests\AbstractStrategyTest;

/**
 * @internal
 */
class HashTest extends AbstractStrategyTest
{
    protected function getStrategy()
    {
        return new Hash($this->prophesize('React\EventLoop\LoopInterface')->reveal());
    }
}
