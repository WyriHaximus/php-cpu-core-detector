<?php

namespace WyriHaximus\CpuCoreDetector\Tests\Core;

use Phake;
use WyriHaximus\CpuCoreDetector\Core\CountCollection;

class CountCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIterator()
    {
        $count0 = Phake::mock('WyriHaximus\CpuCoreDetector\Core\CountInterface');
        $count1 = Phake::mock('WyriHaximus\CpuCoreDetector\Core\CountInterface');
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
