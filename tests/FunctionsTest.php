<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;

use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Collections;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\DetectorCollection;
use function WyriHaximus\CpuCoreDetector\getDefaultCollections;
use function WyriHaximus\CpuCoreDetector\getDefaultCounters;
use function WyriHaximus\CpuCoreDetector\getDefaultDetectors;

/**
 * @internal
 */
final class FunctionsTest extends TestCase
{
    public function testGetDefaultCollections(): void
    {
        $loop = $this->prophesize(LoopInterface::class);
        $collection = getDefaultCollections($loop->reveal());
        $this->assertInstanceOf(Collections::class, $collection);
        $this->assertInstanceOf(DetectorCollection::class, $collection->getDetectors());
        $this->assertInstanceOf(CountCollection::class, $collection->getCounters());
    }

    public function testGetDefaultDetectors(): void
    {
        $loop = $this->prophesize(LoopInterface::class);
        $detectors = getDefaultDetectors($loop->reveal());
        $this->assertInstanceOf(DetectorCollection::class, $detectors);
    }

    public function testGetDefaultCounters(): void
    {
        $loop = $this->prophesize(LoopInterface::class);
        $counters = getDefaultCounters($loop->reveal());
        $this->assertInstanceOf(CountCollection::class, $counters);
    }
}
