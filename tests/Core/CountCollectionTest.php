<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;
use WyriHaximus\TestUtilities\TestCase;

final class CountCollectionTest extends TestCase
{
    public function testIterator(): void
    {
        $count0     = $this->prophesize(CountInterface::class)->reveal();
        $count1     = $this->prophesize(CountInterface::class)->reveal();
        $collection = new CountCollection([$count0, $count1]);
        self::assertTrue($collection->valid());
        self::assertSame(0, $collection->key());
        self::assertSame($count0, $collection->current());
        $collection->next();
        self::assertTrue($collection->valid());
        self::assertSame(1, $collection->key());
        self::assertSame($count1, $collection->current());
        $collection->next();
        self::assertFalse($collection->valid());
        $collection->rewind();
        self::assertTrue($collection->valid());
        self::assertSame(0, $collection->key());
        self::assertSame($count0, $collection->current());
    }
}
