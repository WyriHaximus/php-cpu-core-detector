<?php

namespace WyriHaximus\CpuCoreDetector\Core\Count;

use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\React\ChildProcess\Pool\Os;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;

class Nproc implements CountInterface
{
    /**
     * @param Detector|null $detector
     * @return bool
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
     * @param LoopInterface $loop
     */
    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    /**
     * @return string
     */
    public function getCommandName()
    {
        return 'nproc';
    }

    /**
     * @return PromiseInterface
     */
    public function execute()
    {
        return \WyriHaximus\React\childProcessPromise($this->loop, new Process('nproc'))->then(function ($result) {
            if ($result['exitCode'] == 0) {
                return \React\Promise\resolve((int) trim($result['buffers']['stdout']));
            }

            return \React\Promise\reject();
        });
    }
}
