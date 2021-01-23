<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Core\Affinity;

use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

use function React\Promise\resolve;

final class Taskset implements AffinityInterface
{
    public function supportsCurrentOS(): bool
    {
        return (new Detector())->isUnixLike();
    }

    public function getCommandName(): string
    {
        return 'taskset';
    }

    /**
     * @param  mixed $address
     * @param  mixed $cmd
     */
    public function execute($address = 0, $cmd = ''): PromiseInterface
    {
        return resolve('taskset -c ' . $address . ' ' . $cmd);
    }
}
