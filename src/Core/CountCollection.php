<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Core;

final class CountCollection implements CoreCollectionInterface
{
    /** @var array<CountInterface> */
    protected array $counters;

    protected int $position = 0;

    /**
     * @param array<CountInterface> $counters
     */
    public function __construct(array $counters)
    {
        $this->counters = $counters;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): CountInterface
    {
        return $this->counters[$this->position];
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
        /** @phpstan-ignore-next-line */
        return isset($this->counters[$this->position]);
    }
}
