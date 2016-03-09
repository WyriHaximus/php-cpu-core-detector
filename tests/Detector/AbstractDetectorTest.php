<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Detector;

use WyriHaximus\CpuCoreDetector\Tests\Core\AbstractCoreTest;

abstract class AbstractDetectorTest extends AbstractCoreTest
{
    public function testImplementsDetectorInterface()
    {
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\DetectorInterface', $this->getStrategy());
    }

    public function testGetCommandName()
    {
        $this->assertInternalType('string', $this->getStrategy()->getCommandName());
    }
}
