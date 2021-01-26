<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core\Affinity;

use WyriHaximus\CpuCoreDetector\Core\Affinity\Taskset;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

final class TasksetTest extends AbstractAffinityTest
{
    protected function getStrategy(): AffinityInterface
    {
        return new Taskset();
    }
}
