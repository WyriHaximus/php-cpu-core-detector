<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use WyriHaximus\CpuCoreDetector\Collections;
use WyriHaximus\CpuCoreDetector\Core\AffinityCollectionInterface;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Core\CoreCollectionInterface;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\CpuCoreDetector\Detector;
use WyriHaximus\CpuCoreDetector\DetectorCollectionInterface;
use WyriHaximus\TestUtilities\TestCase;

use function React\Promise\resolve;

final class DetectorTest extends TestCase
{
    public function testDetect(): void
    {
        $counters   = $this->prophesize(CoreCollectionInterface::class);
        $affinities = $this->prophesize(AffinityCollectionInterface::class);

        $counter = $this->prophesize(CountInterface::class);
        $counter->execute()->shouldBeCalled()->willReturn(resolve(128));

        $affinity = $this->prophesize(AffinityInterface::class);

        $detectors = $this->prophesize(DetectorCollectionInterface::class);
        $detectors->execute($counters)->willReturn(resolve($counter->reveal()));
        $detectors->execute($affinities)->willReturn(resolve($affinity->reveal()));

        $collection = new Collections($detectors->reveal(), $counters->reveal(), $affinities->reveal());

        self::assertSame(128, Detector::detectWithCollections($collection));
    }
}
