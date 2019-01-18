<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Detector;

use WyriHaximus\CpuCoreDetector\DetectorInterface;

use WyriHaximus\CpuCoreDetector\Tests\Core\AbstractCoreTest;

abstract class AbstractDetectorTest extends AbstractCoreTest
{
    public function testImplementsDetectorInterface(): void
    {
        $this->assertInstanceOf(DetectorInterface::class, $this->getStrategy());
    }

    public function testGetCommandName(): void
    {
        $this->assertInternalType('string', $this->getStrategy()->getCommandName());
    }
}
