<?php

namespace WyriHaximus\CpuCoreDetector\Tests;

use Phake;

class FunctionsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDefaultCollections()
    {
        $loop = Phake::mock('React\EventLoop\LoopInterface');
        $collection = \WyriHaximus\CpuCoreDetector\getDefaultCollections($loop);
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\Collections', $collection);
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\DetectorCollection', $collection->getDetectors());
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\Core\CountCollection', $collection->getCounters());
    }

    public function testGetDefaultDetectors()
    {
        $loop = Phake::mock('React\EventLoop\LoopInterface');
        $detectors = \WyriHaximus\CpuCoreDetector\getDefaultDetectors($loop);
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\DetectorCollection', $detectors);
    }

    public function testGetDefaultCounters()
    {
        $loop = Phake::mock('React\EventLoop\LoopInterface');
        $counters = \WyriHaximus\CpuCoreDetector\getDefaultCounters($loop);
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\Core\CountCollection', $counters);
    }
}
