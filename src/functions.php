<?php

namespace WyriHaximus\CpuCoreDetector;

use React\EventLoop\LoopInterface;
use WyriHaximus\CpuCoreDetector\Core\Count\Nproc;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Detector\Hash;

/**
 * @return Collections
 */
function getDefaultCollections(LoopInterface $loop)
{
    return new Collections(
        getDefaultDetectors($loop),
        getDefaultCounters($loop)
    );
}

/**
 * @return DetectorCollection
 */
function getDefaultDetectors(LoopInterface $loop)
{
    return new DetectorCollection([
        new Hash($loop),
    ]);
}

/**
 * @return CountCollection
 */
function getDefaultCounters(LoopInterface $loop)
{
    return new CountCollection([
        new Nproc($loop),
    ]);
}
