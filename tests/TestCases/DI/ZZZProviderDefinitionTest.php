<?php

namespace Bellisq\TypeMap\Tests\TestCases\DI;

use Bellisq\TypeMap\DI\Storage\ProviderDefinition;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;
use Bellisq\TypeMap\Exceptions\DI\InvalidClassException;
use Bellisq\TypeMap\Exceptions\DI\UnqualifiedClosureException;
use Bellisq\TypeMap\Exceptions\DuplicateSupportedTypeException;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectDependingOnB;
use Bellisq\TypeMap\Tests\Mocks\DI\ZZZProvider;
use PHPUnit\Framework\TestCase;


class ZZZProviderDefinitionTest
    extends TestCase
{
    /** @var ProviderRegister */
    private $register;

    /** @var ProviderDefinition */
    private $definition;

    public function setUp()
    {
        $this->register = new ProviderRegister(
            $this->definition = new ProviderDefinition
        );
    }

    public function testBehavior()
    {
        $closure = function (): ZZZObjectDependingOnB {
        };
        $this->register
            ->registerClass(ZZZProvider::class)
            ->registerFactory($closure);

        $this->assertEquals([
            ZZZObjectA::class, ZZZObjectB::class, ZZZObjectDependingOnB::class
        ], $this->definition->getList());

        $this->assertEquals(
            ProviderDefinition::PROVIDER_CLASS,
            $this->definition->getProviderType(ZZZObjectA::class)
        );
        $this->assertEquals(
            ProviderDefinition::PROVIDER_FACTORY,
            $this->definition->getProviderType(ZZZObjectDependingOnB::class)
        );

        $this->assertEquals(ZZZProvider::class, $this->definition->getClassName(ZZZObjectB::class));

        $this->assertTrue($closure === $this->definition->getFactory(ZZZObjectDependingOnB::class));
    }

    public function testInvalidClass()
    {
        $this->expectException(InvalidClassException::class);
        $this->register->registerClass(self::class);
    }

    public function testUnqualifiedClosure()
    {
        $this->expectException(UnqualifiedClosureException::class);
        $this->register->registerFactory(function () {
        });
    }

    public function testDuplicateType1()
    {
        $this->expectException(DuplicateSupportedTypeException::class);
        $this->register
            ->registerFactory(function (): ZZZObjectA {
            })
            ->registerClass(ZZZProvider::class);
    }

    public function testDuplicateType2()
    {
        $this->expectException(DuplicateSupportedTypeException::class);
        $this->register
            ->registerClass(ZZZProvider::class)
            ->registerFactory(function (): ZZZObjectA {
            });
    }
}