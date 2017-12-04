<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\Exceptions\CircularDependencyException;
use Bellisq\TypeMap\Exceptions\DuplicateObjectTypeException;
use Bellisq\TypeMap\Exceptions\DuplicateProviderException;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Tests\DI\Containers\ZZZCircularDIContainer;
use Bellisq\TypeMap\Tests\DI\Objects\ZZZObjectA;
use Bellisq\TypeMap\Tests\DI\Objects\ZZZObjectB;
use Bellisq\TypeMap\Tests\DI\Containers\ZZZSimpleDIContainer;
use Bellisq\TypeMap\Tests\DI\ZZZDIContainerDuplicateObjectMock;
use Bellisq\TypeMap\Tests\DI\ZZZDIContainerDuplicationMock;
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
        new ZZZDIContainerDuplicationMock;
    }

    public function testDuplicationObject()
    {
        $this->expectException(DuplicateObjectTypeException::class);
        new ZZZDIContainerDuplicateObjectMock;
    }

}
