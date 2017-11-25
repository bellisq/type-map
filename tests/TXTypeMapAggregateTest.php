<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Exceptions\TooManyCandidatesException;
use Bellisq\TypeMap\TypeMapAggregate;
use PHPUnit\Framework\TestCase;


class TXTypeMapAggregateTest extends TestCase
{

    public function testGet()
    {
        $A = new TypeMapAggregate();
        $B = new TXInstantiatorMock();
        $C = new TXContainerMock();
        $t = new TypeMapAggregate($A, $B, $C);
        $this->assertEquals('hello', $t->get('something'));
        $this->assertEquals('bar', $t->get('foo'));
    }

    public function testObjectNotFoundException()
    {
        $t = new TypeMapAggregate((new TypeMapAggregate()), (new TXInstantiatorMock()));
        $this->expectException(ObjectNotFoundException::class);
        $t->get(TypeMapAggregate::class);
    }

    public function testTooManyCandidatesException()
    {
        $t = new TypeMapAggregate(new TXInstantiatorMock(), new TXInstantiatorMock());
        $this->expectException(TooManyCandidatesException::class);
        $t->get('something');
    }

    public function testHas()
    {
        $t = new TypeMapAggregate();
        $this->assertFalse($t->has('something'));
        $this->assertFalse($t->has('wrong'));
        $t = new TypeMapAggregate(new TXInstantiatorMock());
        $this->assertTrue($t->has('something'));
        $this->assertFalse($t->has('wrong'));
        $t = new TypeMapAggregate(new TXInstantiatorMock(), new TXInstantiatorMock());
        $this->assertFalse($t->has('something'));
        $this->assertFalse($t->has('wrong'));
        $t = new TypeMapAggregate(new TXInstantiatorMock(), new TXContainerMock());
        $this->assertTrue($t->has('something'));
        $this->assertTrue($t->has('foo'));
        $this->assertFalse($t->has('wrong'));
        $A = new TXInstantiatorMock();
        $t = new TypeMapAggregate($A, $A);
        $this->assertFalse($t->has('something'));
        $this->assertFalse($t->has('wrong'));
    }

}
