<?php

namespace WyriHaximus\CpuCoreDetector\Tests;

use Phake;
use React\Promise\FulfilledPromise;
use WyriHaximus\CpuCoreDetector\Collections;
use WyriHaximus\CpuCoreDetector\Detector;

class DetectorTest extends \PHPUnit_Framework_TestCase
{
    public function testDetect()
    {
        $counters = Phake::mock('WyriHaximus\CpuCoreDetector\Core\CountCollection');

        $counter = Phake::mock('WyriHaximus\CpuCoreDetector\Core\CountInterface');
        Phake::when($counter)->execute()->thenReturn(new FulfilledPromise(128));

        $detectors = Phake::mock('WyriHaximus\CpuCoreDetector\DetectorCollection');
        Phake::when($detectors)->execute($counters)->thenReturn(new FulfilledPromise($counter));

        $collection = new Collections($detectors, $counters);

        $this->assertSame(128, Detector::detect($collection));
    }
}
