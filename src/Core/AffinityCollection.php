<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Core;

final class AffinityCollection implements AffinityCollectionInterface
{
    /** @var array<AffinityInterface> */
    protected array $affinities;

    protected int $position = 0;

    /**
     * @param array<AffinityInterface> $affinities
     */
    public function __construct(array $affinities)
    {
        $this->affinities = $affinities;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): AffinityInterface
    {
        return $this->affinities[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        /** @phpstan-ignore-next-line  */
        return isset($this->affinities[$this->position]);
    }
}
