<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\CpuCoreDetector\DetectorCollection;
use WyriHaximus\CpuCoreDetector\DetectorInterface;

use function React\Promise\resolve;

final class DetectorCollectionTest extends AsyncTestCase
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
        $detectorSupported->execute('')->shouldBeCalled()->willReturn(resolve(1));

        $promise         = (new DetectorCollection([
            $detectorUnSupported->reveal(),
            $detectorSupported->reveal(),
        ]))->execute(
            new CountCollection([$counterUnSupported->reveal(), $counterSupported->reveal()])
        );
        $resolvedCounter = $this->await($promise);

        self::assertSame($counterSupported->reveal(), $resolvedCounter);
    }
}
