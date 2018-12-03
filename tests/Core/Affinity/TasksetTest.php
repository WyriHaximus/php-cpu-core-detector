<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use WyriHaximus\CpuCoreDetector\Core\Affinity\Taskset;

/**
 * @internal
 */
final class TasksetTest extends AbstractAffinityTest
{
    protected function getStrategy()
    {
        return new Taskset();
    }
}
