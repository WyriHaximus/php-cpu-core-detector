<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use WyriHaximus\CpuCoreDetector\Tests\AbstractStrategyTest;

abstract class AbstractCoreTest extends AbstractStrategyTest
{
    public function testImplementsCoreInterface()
    {
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\CoreInterface', $this->getStrategy());
    }

    public function testGetCommandName()
    {
        $this->assertInternalType('string', $this->getStrategy()->getCommandName());
    }
}
