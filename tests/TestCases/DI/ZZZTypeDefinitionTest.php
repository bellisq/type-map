<?php

namespace Bellisq\TypeMap\Tests\TestCases\DI;

use Bellisq\TypeMap\DI\Storage\TypeDefinition;
use Bellisq\TypeMap\DI\Transport\TypeRegister;
use Bellisq\TypeMap\Exceptions\DI\DuplicateTypeRegisteredException;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use PHPUnit\Framework\TestCase;


class ZZZTypeDefinitionTest
    extends TestCase
{
    /** @var TypeRegister */
    private $register;

    /** @var TypeDefinition */
    private $definition;

    public function setUp()
    {
        $this->register = new TypeRegister(
            $this->definition = new TypeDefinition
        );
    }

    public function testBehavior()
    {
        $this->register->registerAsFactory(ZZZObjectA::class);
        $this->register->registerAsSingleton(ZZZObjectB::class);

        $this->assertEquals([ZZZObjectA::class, ZZZObjectB::class], $this->definition->getList());
        $this->assertFalse($this->definition->isSingleton(ZZZObjectA::class));
        $this->assertTrue($this->definition->isSingleton(ZZZObjectB::class));
    }

    public function testDuplicate()
    {
        $this->expectException(DuplicateTypeRegisteredException::class);

        $this->register->registerAsFactory(ZZZObjectA::class);
        $this->register->registerAsFactory(ZZZObjectA::class);
    }
}