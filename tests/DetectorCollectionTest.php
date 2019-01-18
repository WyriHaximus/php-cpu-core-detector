<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\CpuCoreDetector\DetectorCollection;
use WyriHaximus\CpuCoreDetector\DetectorInterface;

/**
 * @internal
 */
final class DetectorCollectionTest extends TestCase
{
    public function testDetectorCollection(): void
    {
        $counterUnSupported = $this->prophesize(CountInterface::class);
        $counterUnSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(false);
        $counterSupported = $this->prophesize(CountInterface::class);
        $counterSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(true);
        $counterSupported->getCommandName()->shouldBeCalled()->willReturn('');
        //$counterSupported->execute()->shouldBeCalled()->willReturn(1);

        $detectorUnSupported = $this->prophesize(DetectorInterface::class);
        $detectorUnSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(false);
        $detectorSupported = $this->prophesize(DetectorInterface::class);
        $detectorSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(true);
        $detectorSupported->execute('')->shouldBeCalled()->willReturn(1);

        $resolvedCounter = $this->await((new DetectorCollection([$detectorUnSupported->reveal(), $detectorSupported->reveal()]))->execute(
            new CountCollection([$counterUnSupported->reveal(), $counterSupported->reveal()])
        ));

        $this->assertSame($counterSupported->reveal(), $resolvedCounter);
    }
}
