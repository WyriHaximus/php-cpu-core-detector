<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use React\EventLoop\LoopInterface;

interface DetectorInterface extends StrategyInterface
{
    public function __construct(LoopInterface $loop);
}
