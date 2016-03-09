<?php

namespace WyriHaximus\CpuCoreDetector\Tests;

use Phake;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Detector;
use WyriHaximus\CpuCoreDetector\DetectorCollection;

class DetectorCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testDetectorCollection()
    {
        $counterUnSupported = Phake::mock('WyriHaximus\CpuCoreDetector\Core\CountInterface');
        Phake::when($counterUnSupported)->supportsCurrentOS()->thenReturn(false);
        $counterSupported = Phake::mock('WyriHaximus\CpuCoreDetector\Core\CountInterface');
        Phake::when($counterSupported)->supportsCurrentOS()->thenReturn(true);

        $detectorUnSupported = Phake::mock('WyriHaximus\CpuCoreDetector\DetectorInterface');
        Phake::when($detectorUnSupported)->supportsCurrentOS()->thenReturn(false);
        $detectorSupported = Phake::mock('WyriHaximus\CpuCoreDetector\DetectorInterface');
        Phake::when($detectorSupported)->supportsCurrentOS()->thenReturn(true);

        $promiseResolved = false;
        (new DetectorCollection([$detectorUnSupported, $detectorSupported]))->execute(new CountCollection([$counterUnSupported, $counterSupported]))->then(function ($resolvedCounter) use (&$promiseResolved, $counterSupported) {
            $this->assertSame($counterSupported, $resolvedCounter);
            $promiseResolved = true;
        });

        $this->assertTrue($promiseResolved);
    }
}
