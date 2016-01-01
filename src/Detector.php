<?php

namespace WyriHaximus\CpuCoreDetector;

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Core\Count\Nproc;
use WyriHaximus\CpuCoreDetector\Detector\Hash;

class Detector
{
    public static function detect()
    {
        $return = null;
        $loop = Factory::create();

        $assign = function ($value) use (&$return) {
            $return = $value;
        };
        static::detectAsync($loop)->then($assign, $assign);

        $loop->run();

        if ($return instanceof \Exception) {
            throw $return;
        }

        return $return;
    }

    public static function detectAsync(LoopInterface $loop)
    {
        $nproc = new Nproc($loop);
        return (new Hash($loop))->execute($nproc->getCommandName())->then(function () use ($nproc) {
            return $nproc->execute();
        });
    }
}
