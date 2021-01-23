<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Collections;
use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\CpuCoreDetector\getDefaultAffinities;
use function WyriHaximus\CpuCoreDetector\getDefaultCounters;
use function WyriHaximus\CpuCoreDetector\getDefaultDetectors;

final class CollectionsTest extends TestCase
{
    public function testCollections(): void
    {
        $loop       = $this->prophesize(LoopInterface::class)->reveal();
        $detectors  = getDefaultDetectors($loop);
        $counters   = getDefaultCounters($loop);
        $affinities = getDefaultAffinities($loop);
        $collection = new Collections($detectors, $counters, $affinities);
        self::assertSame($detectors, $collection->detectors());
        self::assertSame($counters, $collection->counters());
        self::assertSame($affinities, $collection->affinities());
    }
}
