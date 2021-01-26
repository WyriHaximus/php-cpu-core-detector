<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use WyriHaximus\CpuCoreDetector\Core\AffinityCollectionInterface;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Core\CoreCollectionInterface;

final class Collections
{
    protected DetectorCollectionInterface $detectors;
    /**
     * @psalm-suppress TooManyTemplateParams
     * @var CoreCollectionInterface<CoreInterface>
     */
    protected CoreCollectionInterface $counters;
    /**
     * @psalm-suppress TooManyTemplateParams
     * @var AffinityCollectionInterface<AffinityInterface>
     */
    protected AffinityCollectionInterface $affinities;

    /**
     * @param CoreCollectionInterface<CoreInterface>         $counters
     * @param AffinityCollectionInterface<AffinityInterface> $affinities
     *
     * @psalm-suppress TooManyTemplateParams
     */
    public function __construct(
        DetectorCollectionInterface $detectors,
        CoreCollectionInterface $counters,
        AffinityCollectionInterface $affinities
    ) {
        $this->detectors  = $detectors;
        $this->counters   = $counters;
        $this->affinities = $affinities;
    }

    public function detectors(): DetectorCollectionInterface
    {
        return $this->detectors;
    }

    /**
     * @return CoreCollectionInterface<CoreInterface>
     *
     * @psalm-suppress TooManyTemplateParams
     */
    public function counters(): CoreCollectionInterface
    {
        return $this->counters;
    }

    /**
     * @return AffinityCollectionInterface<AffinityInterface>
     *
     * @psalm-suppress TooManyTemplateParams
     */
    public function affinities(): AffinityCollectionInterface
    {
        return $this->affinities;
    }
}
