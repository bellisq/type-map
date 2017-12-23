<?php

namespace Bellisq\TypeMap\Tests\TestCases\Utility;

use Bellisq\TypeMap\Exceptions\ClassNotFoundException;
use Bellisq\TypeMap\Exceptions\IncompletableArgumentException;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectDependingOnB;
use Bellisq\TypeMap\Utility\ArgumentAutoComplete;
use Bellisq\TypeMap\Utility\ObjectContainer;
use PHPUnit\Framework\TestCase;


class ZZZArgumentAutoCompleteTest
    extends TestCase
{
    public function testCallSuccess()
    {
        $aac = new ArgumentAutoComplete(new ObjectContainer(new ZZZObjectA, new ZZZObjectB));

        $this->assertTrue(33.4 === $aac->call(
                function (ZZZObjectA $za, ZZZObjectB $zb): float {
                    return 33.4;
                })
        );
    }

    public function testCallNoType()
    {
        $aac = new ArgumentAutoComplete(new ObjectContainer);

        $this->expectException(IncompletableArgumentException::class);
        $aac->call(function ($t) {
        });
    }

    public function testCallVariadic()
    {
        $aac = new ArgumentAutoComplete(new ObjectContainer);

        $this->expectException(IncompletableArgumentException::class);
        $aac->call(function (ZZZObjectA ...$t) {
        });
    }

    public function testCallBuiltin()
    {
        $aac = new ArgumentAutoComplete(new ObjectContainer);

        $this->expectException(IncompletableArgumentException::class);
        $aac->call(function (int $t) {
        });
    }

    public function testCallNotSupported()
    {
        $aac = new ArgumentAutoComplete(new ObjectContainer);

        $this->expectException(IncompletableArgumentException::class);
        $aac->call(function (ZZZObjectA $t) {
        });
    }

    public function testInstantiate()
    {
        $aac = new ArgumentAutoComplete(new ObjectContainer(new ZZZObjectB));

        $this->assertInstanceOf(
            ZZZObjectDependingOnB::class,
            $aac->instantiate(ZZZObjectDependingOnB::class)
        );
    }

    public function testInstantiateNotFound()
    {
        $aac = new ArgumentAutoComplete(new ObjectContainer);

        $this->expectException(ClassNotFoundException::class);
        $aac->instantiate('UNDEFINED_CLASS');
    }
}