<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use React\Promise\PromiseInterface;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

interface DetectorCollectionInterface
{
    /**
     * @param CollectionInterface<AffinityInterface|CoreInterface|DetectorInterface> $possibilities
     *
     * @psalm-suppress TooManyTemplateParams
     */
    public function execute(CollectionInterface $possibilities): PromiseInterface;
}
