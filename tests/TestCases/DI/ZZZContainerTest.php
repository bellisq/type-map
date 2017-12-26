<?php

namespace Bellisq\TypeMap\Tests\TestCases\DI;

use Bellisq\TypeMap\Exceptions\DI\CircularDependencyException;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectDependingOnB;
use Bellisq\TypeMap\Tests\Mocks\DI\ZZZCircularContainer;
use Bellisq\TypeMap\Tests\Mocks\DI\ZZZContainer;
use PHPUnit\Framework\TestCase;


class ZZZContainerTest
    extends TestCase
{
    public function testBehavior()
    {
        $cont = new ZZZContainer;
        $this->assertEquals([
            ZZZObjectDependingOnB::class, ZZZObjectB::class, ZZZObjectA::class
        ], $cont->list());

        $this->assertInstanceOf(ZZZObjectDependingOnB::class, $cont->get(ZZZObjectDependingOnB::class));
        $this->assertInstanceOf(ZZZObjectB::class, $cont->get(ZZZObjectB::class));
        $this->assertInstanceOf(ZZZObjectA::class, $cont->get(ZZZObjectA::class));

        $a1 = $cont->get(ZZZObjectA::class);
        $a2 = $cont->get(ZZZObjectA::class);
        $this->assertTrue($a1 !== $a2);

        $b1 = $cont->get(ZZZObjectB::class);
        $b2 = $cont->get(ZZZObjectB::class);
        $this->assertTrue($b1 === $b2);

        $x1 = $cont->get(ZZZObjectDependingOnB::class);
        $x2 = $cont->get(ZZZObjectDependingOnB::class);
        $this->assertTrue($x1 !== $x2);
    }

    public function testCircular()
    {
        $this->expectException(CircularDependencyException::class);
        (new ZZZCircularContainer)->get(ZZZObjectA::class);
    }
}