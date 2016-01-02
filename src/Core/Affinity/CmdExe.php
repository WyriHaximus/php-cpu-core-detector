<?php

namespace WyriHaximus\CpuCoreDetector\Core\Affinity;

use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\React\ChildProcess\Pool\Os;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

class CmdExe implements AffinityInterface
{
    /**
     * @return array
     */
    public static function supportsCurrentOS(Detector $detector = null)
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
     * @return PromiseInterface
     */
    public function execute($address = 0, $cmd = '')
    {
        return 'cmd.exe /C start /affinity ' . $address . ' ' . $cmd;
    }
}
