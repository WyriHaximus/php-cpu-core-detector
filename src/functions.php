<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Core\Affinity\Taskset;
use WyriHaximus\CpuCoreDetector\Core\AffinityCollection;
use WyriHaximus\CpuCoreDetector\Core\AffinityCollectionInterface;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Core\CoreCollectionInterface;
use WyriHaximus\CpuCoreDetector\Core\Count\Nproc;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Detector\Hash;

function getDefaultCollections(LoopInterface $loop): Collections
{
    return new Collections(
        getDefaultDetectors($loop),
        getDefaultCounters($loop),
        getDefaultAffinities($loop)
    );
}

function getDefaultDetectors(LoopInterface $loop): DetectorCollection
{
    return new DetectorCollection([
        new Hash($loop),
    ]);
}

/**
 * @return CoreCollectionInterface<CoreInterface>
 *
 * @psalm-suppress TooManyTemplateParams
 */
function getDefaultCounters(LoopInterface $loop): CoreCollectionInterface
{
    return new CountCollection([
        new Nproc($loop),
    ]);
}

/**
 * @return AffinityCollectionInterface<AffinityInterface>
 *
 * @psalm-suppress TooManyTemplateParams
 */
function getDefaultAffinities(LoopInterface $loop): AffinityCollectionInterface
{
    return new AffinityCollection([
        new Taskset(),
    ]);
}
