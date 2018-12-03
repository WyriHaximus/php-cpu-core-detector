<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;

use WyriHaximus\CpuCoreDetector\Collections;

/**
 * @internal
 */
class CollectionsTest extends TestCase
{
    public function testCollections(): void
    {
        $loop = $this->prophesize('React\EventLoop\LoopInterface')->reveal();
        $detectors = \WyriHaximus\CpuCoreDetector\getDefaultDetectors($loop);
        $counters = \WyriHaximus\CpuCoreDetector\getDefaultCounters($loop);
        $affinities = \WyriHaximus\CpuCoreDetector\getDefaultAffinities($loop);
        $collection = new Collections($detectors, $counters, $affinities);
        $this->assertSame($detectors, $collection->getDetectors());
        $this->assertSame($counters, $collection->getCounters());
        $this->assertSame($affinities, $collection->getAffinities());
    }
}
