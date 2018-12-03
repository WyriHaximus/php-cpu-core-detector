<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;

abstract class AbstractStrategyTest extends TestCase
{
    public function testImplementsStrategyInterface(): void
    {
        $this->assertInstanceOf('WyriHaximus\CpuCoreDetector\StrategyInterface', $this->getStrategy());
    }

    public function testSupportsCurrentOS(): void
    {
        $this->assertInternalType('boolean', $this->getStrategy()->supportsCurrentOS());
    }

    public function testExecute(): void
    {
        $this->assertInstanceOf('React\Promise\PromiseInterface', $this->getStrategy()->execute());
    }

    abstract protected function getStrategy();
}
