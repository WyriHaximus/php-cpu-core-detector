<?php

namespace WyriHaximus\CpuCoreDetector;

use WyriHaximus\CpuCoreDetector\Core\CountCollection;

class Collections
{
    /**
     * @var DetectorCollection
     */
    protected $detectors;

    /**
     * @var CountCollection
     */
    protected $counters;

    public function __construct(DetectorCollection $detectors, CountCollection $counters)
    {
        $this->detectors = $detectors;
        $this->counters = $counters;
    }

    /**
     * @return DetectorCollection
     */
    public function getDetectors()
    {
        return $this->detectors;
    }

    /**
     * @return CountCollection
     */
    public function getCounters()
    {
        return $this->counters;
    }
}
