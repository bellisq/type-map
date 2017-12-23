<?php

namespace Bellisq\TypeMap\Tests\TestCases\Utility;

use Bellisq\TypeMap\Exceptions\DuplicateSupportedTypeException;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Utility\ObjectContainer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;


class ZZZObjectContainerTest
    extends TestCase
{
    public function testBehavior()
    {
        $typeMap = new ObjectContainer(new ZZZObjectA, [new ZZZObjectB, stdClass::class]);

        $this->assertTrue($typeMap->supports(ZZZObjectA::class));
        $this->assertFalse($typeMap->supports(ZZZObjectB::class));
        $this->assertTrue($typeMap->supports(stdClass::class));

        $this->assertEquals([ZZZObjectA::class, stdClass::class], $typeMap->list());

        $this->assertInstanceOf(ZZZObjectA::class, $typeMap->get(ZZZObjectA::class));
        $this->assertInstanceOf(ZZZObjectB::class, $typeMap->get(stdClass::class));
    }

    public function testInvalidInitializer1()
    {
        $this->expectException(InvalidArgumentException::class);
        new ObjectContainer('33.4');
    }

    public function testInvalidInitializer2()
    {
        $this->expectException(InvalidArgumentException::class);
        new ObjectContainer([new ZZZObjectB, stdClass::class, 33.4]);
    }

    public function testInvalidInitializer3()
    {
        $this->expectException(InvalidArgumentException::class);
        new ObjectContainer([2 => new ZZZObjectB, 3 => ZZZObjectB::class]);
    }

    public function testInvalidInitializer4()
    {
        $this->expectException(InvalidArgumentException::class);
        new ObjectContainer([33.4, ZZZObjectB::class]);
    }

    public function testInvalidInitializer5()
    {
        $this->expectException(InvalidArgumentException::class);
        new ObjectContainer([0 => new ZZZObjectB, 2 => ZZZObjectB::class]);
    }

    public function testInvalidInitializer6()
    {
        $this->expectException(InvalidArgumentException::class);
        new ObjectContainer([new ZZZObjectB, 33.4]);
    }

    public function testInvalidInitializer7()
    {
        $this->expectException(InvalidArgumentException::class);
        new ObjectContainer([new ZZZObjectB, ZZZObjectA::class]);
    }

    public function testDuplicateInitializer()
    {
        $this->expectException(DuplicateSupportedTypeException::class);
        new ObjectContainer(new ZZZObjectA, new ZZZObjectA);
    }
}