<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use Exception;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;

use function React\Promise\resolve;

final class Detector
{
    public static function detect(): int
    {
        $return = null;
        $loop   = Factory::create();

        /**
         * @psalm-suppress MissingClosureParamType
         */
        $assign = static function ($value) use (&$return): void {
            $return = $value;
        };
        static::detectAsync($loop)->then($assign, $assign);

        $loop->run();

        if ($return instanceof Exception) {
            throw $return;
        }

        return $return;
    }

    public static function detectWithCollections(Collections $collections): int
    {
        $return = null;
        $loop   = Factory::create();

        /**
         * @psalm-suppress MissingClosureParamType
         */
        $assign = static function ($value) use (&$return): void {
            $return = $value;
        };
        static::detectAsyncWithCollections($loop, $collections)->then($assign, $assign);

        $loop->run();

        if ($return instanceof Exception) {
            throw $return;
        }

        return $return;
    }

    public static function detectAsync(LoopInterface $loop): PromiseInterface
    {
        return self::detectAsyncWithCollections($loop, getDefaultCollections($loop));
    }

    public static function detectAsyncWithCollections(LoopInterface $loop, Collections $collections): PromiseInterface
    {
        /** @psalm-suppress InvalidArgument */
        return $collections->detectors()->execute(
            $collections->counters()
        )->then(static function (CountInterface $counter): PromiseInterface {
            return $counter->execute();
        })->then(
            static function (int $count) use ($collections): PromiseInterface {
                /** @psalm-suppress InvalidArgument */
                return $collections->detectors()->execute(
                    $collections->affinities()
                )->then(static function (AffinityInterface $affinity) use ($count): PromiseInterface {
                    Resolver::setAffinity($affinity);

                    return resolve($count);
                });
            }
        );
    }
}
