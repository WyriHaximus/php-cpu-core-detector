<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use React\Promise\PromiseInterface;

interface StrategyInterface
{
    public function supportsCurrentOS(): bool;

    public function execute(): PromiseInterface;
}
