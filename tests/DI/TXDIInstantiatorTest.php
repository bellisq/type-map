<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\DIInstantiator;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Tests\Utility\TXFooInstantiatorMock;
use Bellisq\TypeMap\Tests\Utility\ZZZFoo;
use PHPUnit\Framework\TestCase;


class TXDIInstantiatorTest extends TestCase
{

    public function testGet()
    {
        $dii = new DIInstantiator(new TXFooInstantiatorMock());
        $this->assertEquals(ZZZFoo::class, get_class($dii->get(ZZZFoo::class)));
    }

    public function testObjectNotFoundException()
    {
        $dii = new DIInstantiator(new TXFooInstantiatorMock());
        $this->expectException(ObjectNotFoundException::class);
        $this->assertEquals(ZZZFoo::class, get_class($dii->get('wrong')));
    }

    public function testHas()
    {
        $dii = new DIInstantiator(new TXFooInstantiatorMock());
        $this->assertTrue($dii->has(ZZZFoo::class));
        $this->assertFalse($dii->has('wrong'));
    }

}
