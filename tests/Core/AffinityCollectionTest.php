<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use ApiClients\Tools\TestUtilities\TestCase;

use WyriHaximus\CpuCoreDetector\Core\AffinityCollection;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

/**
 * @internal
 */
final class AffinityCollectionTest extends TestCase
{
    public function testIterator(): void
    {
        $affinity0 = $this->prophesize(AffinityInterface::class)->reveal();
        $affinity1 = $this->prophesize(AffinityInterface::class)->reveal();
        $collection = new AffinityCollection([$affinity0, $affinity1]);
        $this->assertTrue($collection->valid());
        $this->assertSame(0, $collection->key());
        $this->assertSame($affinity0, $collection->current());
        $collection->next();
        $this->assertTrue($collection->valid());
        $this->assertSame(1, $collection->key());
        $this->assertSame($affinity1, $collection->current());
        $collection->next();
        $this->assertFalse($collection->valid());
        $collection->rewind();
        $this->assertTrue($collection->valid());
        $this->assertSame(0, $collection->key());
        $this->assertSame($affinity0, $collection->current());
    }
}
