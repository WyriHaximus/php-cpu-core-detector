<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;

use React\Promise\PromiseInterface;

use WyriHaximus\CpuCoreDetector\StrategyInterface;

abstract class AbstractStrategyTest extends TestCase
{
    public function testImplementsStrategyInterface(): void
    {
        $this->assertInstanceOf(StrategyInterface::class, $this->getStrategy());
    }

    public function testSupportsCurrentOS(): void
    {
        $this->assertInternalType('boolean', $this->getStrategy()->supportsCurrentOS());
    }

    public function testExecute(): void
    {
        $this->assertInstanceOf(PromiseInterface::class, $this->getStrategy()->execute());
    }

    abstract protected function getStrategy();
}
