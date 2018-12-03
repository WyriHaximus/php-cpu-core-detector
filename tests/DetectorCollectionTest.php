<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\CpuCoreDetector\DetectorCollection;

/**
 * @internal
 */
final class DetectorCollectionTest extends TestCase
{
    public function testDetectorCollection(): void
    {
        $counterUnSupported = $this->prophesize(CountInterface::class);
        $counterUnSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(false);
        $counterSupported = $this->prophesize('WyriHaximus\CpuCoreDetector\Core\CountInterface');
        $counterSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(true);
        $counterSupported->getCommandName()->shouldBeCalled()->willReturn('');
        //$counterSupported->execute()->shouldBeCalled()->willReturn(1);

        $detectorUnSupported = $this->prophesize('WyriHaximus\CpuCoreDetector\DetectorInterface');
        $detectorUnSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(false);
        $detectorSupported = $this->prophesize('WyriHaximus\CpuCoreDetector\DetectorInterface');
        $detectorSupported->supportsCurrentOS()->shouldBeCalled()->willReturn(true);
        $detectorSupported->execute('')->shouldBeCalled()->willReturn(1);

        $resolvedCounter = $this->await((new DetectorCollection([$detectorUnSupported->reveal(), $detectorSupported->reveal()]))->execute(
            new CountCollection([$counterUnSupported->reveal(), $counterSupported->reveal()])
        ));

        $this->assertSame($counterSupported->reveal(), $resolvedCounter);
    }
}
