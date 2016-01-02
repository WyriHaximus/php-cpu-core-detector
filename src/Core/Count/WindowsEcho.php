<?php

namespace WyriHaximus\CpuCoreDetector\Core\Count;

use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\React\ChildProcess\Pool\Os;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;

class WindowsEcho implements CountInterface
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
        return $detector->isWindowsLike();
    }

    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * WindowsEcho constructor.
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
        return 'echo';
    }

    /**
     * @return PromiseInterface
     */
    public function execute()
    {
        return \WyriHaximus\React\childProcessPromise($this->loop, new Process('echo %NUMBER_OF_PROCESSORS%'))->then(function ($result) {
            if ($result['exitCode'] == 0) {
                return \React\Promise\resolve((int) trim($result['buffers']['stdout']));
            }

            return \React\Promise\reject();
        });
    }
}
