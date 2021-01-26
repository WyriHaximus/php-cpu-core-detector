<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use WyriHaximus\CpuCoreDetector\Core\AffinityCollection;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\TestUtilities\TestCase;

final class AffinityCollectionTest extends TestCase
{
    public function testIterator(): void
    {
        $affinity0  = $this->prophesize(AffinityInterface::class)->reveal();
        $affinity1  = $this->prophesize(AffinityInterface::class)->reveal();
        $collection = new AffinityCollection([$affinity0, $affinity1]);
        self::assertTrue($collection->valid());
        self::assertSame(0, $collection->key());
        self::assertSame($affinity0, $collection->current());
        $collection->next();
        self::assertTrue($collection->valid());
        self::assertSame(1, $collection->key());
        self::assertSame($affinity1, $collection->current());
        $collection->next();
        self::assertFalse($collection->valid());
        $collection->rewind();
        self::assertTrue($collection->valid());
        self::assertSame(0, $collection->key());
        self::assertSame($affinity0, $collection->current());
    }
}
