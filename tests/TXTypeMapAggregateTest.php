<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Exceptions\MultipleCandidatesException;
use Bellisq\TypeMap\TypeMapAggregate;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiator;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiatorClass;
use Bellisq\TypeMap\Tests\TXContainerMock;
use PHPUnit\Framework\TestCase;


class TXTypeMapAggregateTest extends TestCase
{

    public function testGet()
    {
        $A = new TypeMapAggregate;
        $B = new ZZZSimpleInstantiator;
        $C = new TXContainerMock;

        $t = new TypeMapAggregate($A, $B, $C);

        $this->assertInstanceOf(ZZZSimpleInstantiatorClass::class, $t->get(ZZZSimpleInstantiatorClass::class));
        $this->assertEquals('bar', $t->get('foo'));
    }

    public function testObjectNotFoundException()
    {
        $t = new TypeMapAggregate((new TypeMapAggregate), (new ZZZSimpleInstantiator));
        $this->expectException(ObjectNotFoundException::class);
        $t->get(TypeMapAggregate::class);
    }

    public function testTooManyCandidatesException()
    {
        $t = new TypeMapAggregate(new ZZZSimpleInstantiator, new ZZZSimpleInstantiator);
        $this->expectException(MultipleCandidatesException::class);
        $t->get(ZZZSimpleInstantiatorClass::class);
    }

    public function testHas()
    {
        $t = new TypeMapAggregate;
        $this->assertFalse($t->has(ZZZSimpleInstantiatorClass::class));
        $this->assertFalse($t->has('wrong'));

        $t = new TypeMapAggregate(new ZZZSimpleInstantiator);
        $this->assertTrue($t->has(ZZZSimpleInstantiatorClass::class));
        $this->assertFalse($t->has('wrong'));

        $t = new TypeMapAggregate(new ZZZSimpleInstantiator, new ZZZSimpleInstantiator);
        $this->assertFalse($t->has(ZZZSimpleInstantiatorClass::class));
        $this->assertFalse($t->has('wrong'));

        $t = new TypeMapAggregate(new ZZZSimpleInstantiator, new TXContainerMock);
        $this->assertTrue($t->has(ZZZSimpleInstantiatorClass::class));
        $this->assertTrue($t->has('foo'));
        $this->assertFalse($t->has('wrong'));

        $A = new ZZZSimpleInstantiator;
        $t = new TypeMapAggregate($A, $A);
        $this->assertFalse($t->has(ZZZSimpleInstantiatorClass::class));
        $this->assertFalse($t->has('wrong'));
    }

}
