<?php

namespace WyriHaximus\CpuCoreDetector\Tests;

use Phake;
use WyriHaximus\CpuCoreDetector\Collections;

class CollectionsTest extends \PHPUnit_Framework_TestCase
{
    public function testCollections()
    {
        $loop = Phake::mock('React\EventLoop\LoopInterface');
        $detectors = \WyriHaximus\CpuCoreDetector\getDefaultDetectors($loop);
        $counters = \WyriHaximus\CpuCoreDetector\getDefaultCounters($loop);
        $collection = new Collections($detectors, $counters);
        $this->assertSame($detectors, $collection->getDetectors());
        $this->assertSame($counters, $collection->getCounters());
    }
}
