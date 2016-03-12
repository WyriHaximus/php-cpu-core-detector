<?php

namespace WyriHaximus\CpuCoreDetector\Tests;

use Phake;
use React\Promise\FulfilledPromise;
use WyriHaximus\CpuCoreDetector\Resolver;

class ResolverTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Resolver::reset();
    }

    public function testResolve()
    {
        $promise = new FulfilledPromise();
        $affinity = Phake::mock('WyriHaximus\CpuCoreDetector\Core\AffinityInterface');
        Phake::when($affinity)->execute(13, 'cowsay')->thenReturn($promise);
        Resolver::setAffinity($affinity);
        $this->assertSame($promise, Resolver::resolve(13, 'cowsay'));
        Phake::verify($affinity)->execute(13, 'cowsay');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Affinity not set
     */
    public function testGetAffinity()
    {
        Resolver::getAffinity();
    }

    public function testSetAffinity()
    {
        $affinity = Phake::mock('WyriHaximus\CpuCoreDetector\Core\AffinityInterface');
        Resolver::setAffinity($affinity);
        $this->assertSame($affinity, Resolver::getAffinity());
    }
}
