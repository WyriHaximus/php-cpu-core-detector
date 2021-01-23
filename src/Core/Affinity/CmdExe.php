<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Core\Affinity;

use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

use function React\Promise\resolve;

final class CmdExe implements AffinityInterface
{
    public function supportsCurrentOS(): bool
    {
        return (bool) (new Detector())->isWindowsLike();
    }

    public function getCommandName(): string
    {
        return 'cmd.exe';
    }

    /**
     * @param  mixed $address
     * @param  mixed $cmd
     */
    public function execute($address = 0, $cmd = ''): PromiseInterface
    {
        return resolve('cmd.exe /C start /affinity ' . $address . ' ' . $cmd);
    }
}
