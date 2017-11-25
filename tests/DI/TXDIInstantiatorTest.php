<?php

namespace Bellisq\TypeMap\Tests\Completion;

use Bellisq\TypeMap\Completion\ArgumentCompletor;
use Bellisq\TypeMap\DI\DIInstantiator;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Tests\Completion\TXFooInstantiatorMock;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;


class TXDIInstantiatorTest extends TestCase
{

    public function testGet()
    {
        $dii = new DIInstantiator(new TXFooInstantiatorMock());
        $this->assertEquals(Foo::class, get_class($dii->get(Foo::class)));
    }

    public function testObjectNotFoundException()
    {
        $dii = new DIInstantiator(new TXFooInstantiatorMock());
        $this->expectException(ObjectNotFoundException::class);
        $this->assertEquals(Foo::class, get_class($dii->get('wrong')));
    }

    public function testHas()
    {
        $dii = new DIInstantiator(new TXFooInstantiatorMock());
        $this->assertTrue($dii->has(Foo::class));
        $this->assertFalse($dii->has('wrong'));
    }

}
