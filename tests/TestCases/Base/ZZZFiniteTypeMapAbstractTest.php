<?php

namespace Bellisq\TypeMap\Tests\TestCases\Base;

use Bellisq\TypeMap\Exceptions\DuplicateSupportedTypeException;
use Bellisq\TypeMap\Tests\Mocks\Base\ZZZFiniteTypeMap;
use Bellisq\TypeMap\Tests\Mocks\Base\ZZZFiniteTypeMapWithDuplicateSupportedType;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use PHPUnit\Framework\TestCase;


class ZZZFiniteTypeMapAbstractTest
    extends TestCase
{
    public function testBehavior()
    {
        $typeMap = new ZZZFiniteTypeMap;

        $this->assertEquals([ZZZObjectA::class], $typeMap->list());

        $this->assertTrue($typeMap->supports(ZZZObjectA::class));
        $this->assertFalse($typeMap->supports(self::class));
    }

    public function testDuplicateSupportedType()
    {
        $this->expectException(DuplicateSupportedTypeException::class);
        new ZZZFiniteTypeMapWithDuplicateSupportedType;
    }
}