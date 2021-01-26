<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Detector;

use WyriHaximus\CpuCoreDetector\DetectorInterface;
use WyriHaximus\CpuCoreDetector\Tests\Core\AbstractCoreTest;

abstract class AbstractDetectorTest extends AbstractCoreTest
{
    final public function testImplementsDetectorInterface(): void
    {
        self::assertInstanceOf(DetectorInterface::class, $this->getStrategy());
    }
}
