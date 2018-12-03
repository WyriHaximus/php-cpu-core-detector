<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

interface CoreInterface extends StrategyInterface
{
    /**
     * @return string
     */
    public function getCommandName();
}
