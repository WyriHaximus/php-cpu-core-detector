<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use WyriHaximus\CpuCoreDetector\CoreInterface;
use WyriHaximus\CpuCoreDetector\Tests\AbstractStrategyTest;

abstract class AbstractCoreTest extends AbstractStrategyTest
{
    final public function testImplementsCoreInterface(): void
    {
        self::assertInstanceOf(CoreInterface::class, $this->getStrategy());
    }

    final public function testGetCommandName(): void
    {
        /** @phpstan-ignore-next-line */
        self::assertIsString($this->getStrategy()->getCommandName());
    }
}
