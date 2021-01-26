<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use Exception;
use React\Promise\PromiseInterface;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

final class Resolver
{
    protected static ?AffinityInterface $affinity = null;

    public static function setAffinity(AffinityInterface $affinity): void
    {
        self::$affinity = $affinity;
    }

    public static function getAffinity(): AffinityInterface
    {
        if (! (self::$affinity instanceof AffinityInterface)) {
            /** @phpstan-ignore-next-line */
            throw new Exception('Affinity not set');
        }

        return self::$affinity;
    }

    public static function resolve(string $address, string $cmd = ''): PromiseInterface
    {
        if (! (self::$affinity instanceof AffinityInterface)) {
            /** @phpstan-ignore-next-line */
            throw new Exception('Affinity not set');
        }

        /**
         * @phpstan-ignore-next-line
         * @psalm-suppress TooManyArguments
         */
        return self::getAffinity()->execute($address, $cmd);
    }

    public static function reset(): void
    {
        self::$affinity = null;
    }
}
