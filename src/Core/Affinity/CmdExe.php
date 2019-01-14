<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Core\Affinity;

use React\Promise\PromiseInterface;
use function React\Promise\resolve;
use Tivie\OS\Detector;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

class CmdExe implements AffinityInterface
{
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
        return 'cmd.exe';
    }

    /**
     * @param  mixed            $address
     * @param  mixed            $cmd
     * @return PromiseInterface
     */
    public function execute($address = 0, $cmd = '')
    {
        return resolve('cmd.exe /C start /affinity ' . $address . ' ' . $cmd);
    }
}
