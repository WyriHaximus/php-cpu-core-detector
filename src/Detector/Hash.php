<?php

namespace WyriHaximus\CpuCoreDetector\Detector;

use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use React\Promise\RejectedPromise;
use Tivie\OS\Detector;
use WyriHaximus\React\ChildProcess\Pool\Os;
use WyriHaximus\CpuCoreDetector\DetectorInterface;

class Hash implements DetectorInterface
{
    /**
     * @return array
     */
    public static function supportsCurrentOS(Detector $detector = null)
    {
        if ($detector === null) {
            $detector = new Detector();
        }
        return $detector->isUnixLike();
    }

    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * Hash constructor.
     * @param LoopInterface $loop
     */
    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    /**
     * @param string $program
     * @return PromiseInterface
     */
    public function execute($program = '')
    {
        if ($program === '') {
            return new RejectedPromise();
        }

        $deferred = new Deferred();

        $process = new Process('hash ' . $program);
        $process->on('exit', function ($exitCode) use ($deferred) {
            if ($exitCode == 0) {
                $deferred->resolve();
                return;
            }

            $deferred->reject();
        });

        \WyriHaximus\React\futurePromise($this->loop, $process)->then(function (Process $process) {
            $process->start($this->loop);
        });

        return $deferred->promise();
    }
}
