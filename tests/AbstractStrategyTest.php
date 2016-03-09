<?php

namespace WyriHaximus\CpuCoreDetector\Tests;

abstract class AbstractStrategyTest extends \PHPUnit_Framework_TestCase
{
    abstract protected function getStrategy();

    public function testImplementsStrategyInterface()
    {
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\StrategyInterface', $this->getStrategy());
    }

    public function testSupportsCurrentOS()
    {
        $this->assertInternalType('boolean', $this->getStrategy()->supportsCurrentOS());
    }

    public function testExecute()
    {
        $this->assertInstanceOf('React\Promise\PromiseInterface', $this->getStrategy()->execute());
    }
}
