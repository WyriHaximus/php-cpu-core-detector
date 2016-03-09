<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use WyriHaximus\CpuCoreDetector\Tests\Core\AbstractCoreTest;

abstract class AbstractAffinityTest extends AbstractCoreTest
{
    public function testImplementsCountInterface()
    {
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\Core\AffinityInterface', $this->getStrategy());
    }
}
