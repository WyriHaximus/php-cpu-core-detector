<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Tests\Core\AbstractCoreTest;

abstract class AbstractAffinityTest extends AbstractCoreTest
{
    public function testImplementsCountInterface(): void
    {
        self::assertInstanceOf(AffinityInterface::class, $this->getStrategy());
    }
}
