<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

interface CoreInterface extends StrategyInterface
{
    public function getCommandName(): string;
}
