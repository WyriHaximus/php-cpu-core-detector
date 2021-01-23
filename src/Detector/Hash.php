<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Detector;

use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\CpuCoreDetector\DetectorInterface;
use WyriHaximus\React\ProcessOutcome;

use function React\Promise\reject;
use function React\Promise\resolve;
use function WyriHaximus\React\childProcessPromise;

final class Hash implements DetectorInterface
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

    public function execute(string $program = ''): PromiseInterface
    {
        return childProcessPromise(
            $this->loop,
            new Process('hash ' . $program)
        )->then(static function (ProcessOutcome $outcome): PromiseInterface {
            if ($outcome->getExitCode() === 0) {
                return resolve();
            }

            return reject();
        });
    }
}
