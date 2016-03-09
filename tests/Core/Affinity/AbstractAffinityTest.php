<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Count;

use WyriHaximus\CpuCoreDetector\Tests\Core\AbstractCoreTest;

abstract class AbstractCountTest extends AbstractCoreTest
{
    public function testImplementsCountInterface()
    {
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\Core\CountInterface', $this->getStrategy());
    }
}
