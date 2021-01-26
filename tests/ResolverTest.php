<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector\Tests;

use Throwable;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;
use WyriHaximus\CpuCoreDetector\Resolver;
use WyriHaximus\TestUtilities\TestCase;

use function React\Promise\resolve;

final class ResolverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Resolver::reset();
    }

    public function testResolve(): void
    {
        $promise  = resolve(null);
        $affinity = $this->prophesize(AffinityInterface::class);
        $affinity->execute(13, 'cowsay')->shouldBeCalled()->willReturn($promise);
        Resolver::setAffinity($affinity->reveal());
        self::assertSame($promise, Resolver::resolve('13', 'cowsay'));
    }

    public function testGetAffinity(): void
    {
        self::expectException(Throwable::class);
        self::expectExceptionMessage('Affinity not set');
        Resolver::getAffinity();
    }

    public function testSetAffinity(): void
    {
        $affinity = $this->prophesize(AffinityInterface::class)->reveal();
        Resolver::setAffinity($affinity);
        self::assertSame($affinity, Resolver::getAffinity());
    }
}
