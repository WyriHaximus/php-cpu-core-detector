<?php

namespace WyriHaximus\CpuCoreDetector;

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

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

    }
}
