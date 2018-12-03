<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use WyriHaximus\CpuCoreDetector\CoreInterface;
use WyriHaximus\CpuCoreDetector\Tests\AbstractStrategyTest;

abstract class AbstractCoreTest extends AbstractStrategyTest
{
    public function testImplementsCoreInterface(): void
    {
        self::assertInstanceOf(CoreInterface::class, $this->getStrategy());
    }

    public function testGetCommandName(): void
    {
        self::assertInternalType('string', $this->getStrategy()->getCommandName());
    }
}
