<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use ApiClients\Tools\TestUtilities\TestCase;

use WyriHaximus\CpuCoreDetector\Core\CountCollection;
use WyriHaximus\CpuCoreDetector\Core\CountInterface;

/**
 * @internal
 */
final class CountCollectionTest extends TestCase
{
    public function testIterator(): void
    {
        $count0 = $this->prophesize(CountInterface::class)->reveal();
        $count1 = $this->prophesize(CountInterface::class)->reveal();
        $collection = new CountCollection([$count0, $count1]);
        $this->assertTrue($collection->valid());
        $this->assertSame(0, $collection->key());
        $this->assertSame($count0, $collection->current());
        $collection->next();
        $this->assertTrue($collection->valid());
        $this->assertSame(1, $collection->key());
        $this->assertSame($count1, $collection->current());
        $collection->next();
        $this->assertFalse($collection->valid());
        $collection->rewind();
        $this->assertTrue($collection->valid());
        $this->assertSame(0, $collection->key());
        $this->assertSame($count0, $collection->current());
    }
}
