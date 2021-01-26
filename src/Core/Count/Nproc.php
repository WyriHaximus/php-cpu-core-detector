<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Core\Count;

use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\React\ProcessOutcome;

use function React\Promise\reject;
use function React\Promise\resolve;
use function trim;
use function WyriHaximus\React\childProcessPromise;

final class Nproc implements CountInterface
{
    protected LoopInterface $loop;

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function supportsCurrentOS(): bool
    {
        return (new Detector())->isUnixLike();
    }

    public function getCommandName(): string
    {
        return 'nproc';
    }

    public function execute(): PromiseInterface
    {
        return childProcessPromise(
            $this->loop,
            new Process('nproc')
        )->then(static function (ProcessOutcome $outcome): PromiseInterface {
            if ($outcome->getExitCode() === 0) {
                return resolve((int) trim($outcome->getStdout()));
            }

            return reject();
        });
    }
}
