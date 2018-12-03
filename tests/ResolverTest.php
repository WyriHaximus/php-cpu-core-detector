<?php declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use ApiClients\Tools\TestUtilities\TestCase;
use React\Promise\FulfilledPromise;

use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Resolver;

/**
 * @internal
 */
class ResolverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Resolver::reset();
    }

    public function testResolve(): void
    {
        $promise = new FulfilledPromise();
        $affinity = $this->prophesize(AffinityInterface::class);
        $affinity->execute(13, 'cowsay')->shouldBeCalled()->willReturn($promise);
        Resolver::setAffinity($affinity->reveal());
        $this->assertSame($promise, Resolver::resolve(13, 'cowsay'));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Affinity not set
     */
    public function testGetAffinity(): void
    {
        Resolver::getAffinity();
    }

    public function testSetAffinity(): void
    {
        $affinity = $this->prophesize(AffinityInterface::class)->reveal();
        Resolver::setAffinity($affinity);
        $this->assertSame($affinity, Resolver::getAffinity());
    }
}
