<?php

namespace Bellisq\TypeMap\Tests\TestCases\DI;

use Bellisq\TypeMap\Exceptions\{
    CircularDependencyException,
    DuplicateObjectTypeException,
    DuplicateProviderException,
    ObjectNotFoundException
};
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Containers\{
    ZZZCircularDIContainer,
    ZZZDuplicateObjectDIContainer,
    ZZZDuplicateProviderDIContainer,
    ZZZSimpleDIContainer
};
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Objects\{
    ZZZObjectA,
    ZZZObjectB,
    ZZZObjectC
};
use PHPUnit\Framework\TestCase;


class ZZZDIContainerTest extends TestCase
{

    private $dic;

    public function setUp()
    {
        $this->dic = new ZZZSimpleDIContainer;
    }

    public function testBehavior()
    {
        $this->assertInstanceOf(ZZZObjectB::class, $this->dic->get(ZZZObjectB::class));
        $this->assertInstanceOf(ZZZObjectA::class, $this->dic->get(ZZZObjectA::class));
    }

    public function testCircular()
    {
        $this->expectException(CircularDependencyException::class);
        $dic = new ZZZCircularDIContainer;
        $dic->get(ZZZObjectA::class);
    }

    public function testNotFound()
    {
        $this->expectException(ObjectNotFoundException::class);
        $this->dic->get('NONE_CLASS');
    }

    public function testDuplicateProvider()
    {
        $this->expectException(DuplicateProviderException::class);
        new ZZZDuplicateProviderDIContainer;
    }

    public function testDuplicateObject()
    {
        $this->expectException(DuplicateObjectTypeException::class);
        new ZZZDuplicateObjectDIContainer;
    }

    public function testSingleton()
    {
        $this->assertTrue($this->dic->get(ZZZObjectA::class) == $this->dic->get(ZZZObjectA::class));
        $this->assertFalse($this->dic->get(ZZZObjectA::class) === $this->dic->get(ZZZObjectA::class));
        $this->assertTrue($this->dic->get(ZZZObjectC::class) == $this->dic->get(ZZZObjectC::class));
        $this->assertTrue($this->dic->get(ZZZObjectC::class) === $this->dic->get(ZZZObjectC::class));
    }

}
