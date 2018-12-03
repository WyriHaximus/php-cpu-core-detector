<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;
use React\Promise\FulfilledPromise;
use WyriHaximus\CpuCoreDetector\Collections;

use WyriHaximus\CpuCoreDetector\Core\AffinityCollection;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\CpuCoreDetector\Detector;
use WyriHaximus\CpuCoreDetector\DetectorCollection;

/**
 * @internal
 */
final class DetectorTest extends TestCase
{
    public function testDetect(): void
    {
        $counters = $this->prophesize(CountCollection::class);
        $affinities = $this->prophesize(AffinityCollection::class);

        $counter = $this->prophesize(CountInterface::class);
        $counter->execute()->shouldBeCalled()->willReturn(new FulfilledPromise(128));

        $affinity = $this->prophesize(AffinityInterface::class);

        $detectors = $this->prophesize(DetectorCollection::class);
        $detectors->execute($counters)->willReturn(new FulfilledPromise($counter->reveal()));
        $detectors->execute($affinities)->willReturn(new FulfilledPromise($affinity->reveal()));

        $collection = new Collections($detectors->reveal(), $counters->reveal(), $affinities->reveal());

        $this->assertSame(128, Detector::detect($collection));
    }
}
