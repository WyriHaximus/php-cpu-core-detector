<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Core\Count;

use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\React\ProcessOutcome;

class WindowsEcho implements CountInterface
{

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
     * @param  Detector|null $detector
     * @return bool
     */
    public function supportsCurrentOS(Detector $detector = null)
    {
        if ($detector === null) {
            $detector = new Detector();
        }

        return $detector->isWindowsLike();
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
        return \WyriHaximus\React\childProcessPromise(
            $this->loop,
            new Process('echo %NUMBER_OF_PROCESSORS%')
        )->then(function (ProcessOutcome $outcome) {
            if ($outcome->getExitCode() == 0) {
                return \React\Promise\resolve((int) \trim($outcome->getStdout()));
            }

            return \React\Promise\reject();
        });
    }
}
