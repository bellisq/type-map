<?php

namespace Bellisq\TypeMap\Tests\TestCases\Base;

use Bellisq\TypeMap\Exceptions\UnavailableTypeException;
use Bellisq\TypeMap\Tests\Mocks\Base\ZZZTypeMap;
use Bellisq\TypeMap\Tests\Mocks\Base\ZZZTypeMapWithTypeError;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use PHPUnit\Framework\TestCase;
use TypeError;


class ZZZTypeMapAbstractTest
    extends TestCase
{
    public function testBehavior()
    {
        $typeMap = new ZZZTypeMap;

        $this->assertInstanceOf(ZZZObjectA::class, $typeMap->get(ZZZObjectA::class));

        $this->expectException(UnavailableTypeException::class);
        $typeMap->get(self::class);
    }

    public function testTypeError()
    {
        $typeMap = new ZZZTypeMapWithTypeError;

        $this->expectException(TypeError::class);
        $typeMap->get(ZZZObjectA::class);
    }
}