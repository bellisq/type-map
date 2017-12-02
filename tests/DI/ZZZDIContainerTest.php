<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\Exceptions\CircularDependencyException;
use Bellisq\TypeMap\Exceptions\DuplicateObjectTypeException;
use Bellisq\TypeMap\Exceptions\DuplicateProviderException;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularA;
use Bellisq\TypeMap\Tests\DI\Object\ZZZObjectB;
use Bellisq\TypeMap\Tests\DI\ZZZDIContainerDuplicationMock;
use Bellisq\TypeMap\Tests\DI\ZZZDIContainerDuplicateObjectMock;
use Bellisq\TypeMap\Tests\DI\ZZZDIContainerMock;
use Bellisq\TypeMap\Tests\DI\Object\ZZZObjectA;
use PHPUnit\Framework\TestCase;


class ZZZDIContainerTest extends TestCase
{

    private $dic;

    public function setUp()
    {
        $this->dic = new ZZZDIContainerMock;
    }

    public function testBehavior()
    {
        $this->assertInstanceOf(ZZZObjectB::class, $this->dic->get(ZZZObjectB::class));
        $this->assertInstanceOf(ZZZObjectA::class, $this->dic->get(ZZZObjectA::class));
    }

    public function testCircular()
    {
        $this->expectException(CircularDependencyException::class);
        $this->dic->get(ZZZCircularA::class);
    }

    public function testNotFound()
    {
        $this->expectException(ObjectNotFoundException::class);
        $this->dic->get('NONE_CLASS');
    }

    public function testDuplicateProvider()
    {
        $this->expectException(DuplicateProviderException::class);
        new ZZZDIContainerDuplicationMock;
    }

    public function testDuplicationObject()
    {
        $this->expectException(DuplicateObjectTypeException::class);
        new ZZZDIContainerDuplicateObjectMock;
    }

}