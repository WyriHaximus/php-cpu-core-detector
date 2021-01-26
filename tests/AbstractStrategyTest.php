<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use WyriHaximus\CpuCoreDetector\StrategyInterface;
use WyriHaximus\TestUtilities\TestCase;

abstract class AbstractStrategyTest extends TestCase
{
    abstract protected function getStrategy(): StrategyInterface;
}
