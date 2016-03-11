<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use Phake;
use WyriHaximus\CpuCoreDetector\Core\AffinityCollection;

class AffinityCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIterator()
    {
        $affinity0 = Phake::mock('WyriHaximus\CpuCoreDetector\Core\AffinityInterface');
        $affinity1 = Phake::mock('WyriHaximus\CpuCoreDetector\Core\AffinityInterface');
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
