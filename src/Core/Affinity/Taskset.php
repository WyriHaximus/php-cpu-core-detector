<?php

namespace WyriHaximus\CpuCoreDetector\Core\Affinity;

use React\Promise\PromiseInterface;
use Tivie\OS\Detector;
use WyriHaximus\React\ChildProcess\Pool\Os;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

class Taskset implements AffinityInterface
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
     * @return string
     */
    public function getCommandName()
    {
        return 'taskset';
    }

    /**
     * @return PromiseInterface
     */
    public function execute($address = 0, $cmd = '')
    {
        return 'taskset -c ' . $address . ' ' . $cmd;
    }
}
