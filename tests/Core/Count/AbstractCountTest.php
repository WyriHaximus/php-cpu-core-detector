<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Count;

use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\CpuCoreDetector\Tests\Core\AbstractCoreTest;

abstract class AbstractCountTest extends AbstractCoreTest
{
    public function testImplementsCountInterface(): void
    {
        self::assertInstanceOf(CountInterface::class, $this->getStrategy());
    }
}
