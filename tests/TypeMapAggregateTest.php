<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Exceptions\TooManyCandidatesException;
use Bellisq\TypeMap\TypeMapAggregate;
use PHPUnit\Framework\TestCase;


class TypeMapAggregateTest extends TestCase
{

    public function testGet()
    {
        $A = new TypeMapAggregate();
        $B = new ExampleInstantiator1();
        $C = new ExampleInstantiator2();
        $t = new TypeMapAggregate($A, $B, $C);
        $this->assertEquals('hello', $t->get('something'));
        $this->assertEquals('bar', $t->get('foo'));
    }

    public function testObjectNotFoundException()
    {
        $t = new TypeMapAggregate((new TypeMapAggregate()), (new ExampleInstantiator1()));
        $this->expectException(ObjectNotFoundException::class);
        $t->get(TypeMapAggregate::class);
    }

    public function testTooManyCandidatesException()
    {
        $t = new TypeMapAggregate(new ExampleInstantiator1(), new ExampleInstantiator1());
        $this->expectException(TooManyCandidatesException::class);
        $t->get('something');
    }

    public function testHas()
    {
        $t = new TypeMapAggregate();
        $this->assertFalse($t->has('something'));
        $this->assertFalse($t->has('wrong'));
        $t = new TypeMapAggregate(new ExampleInstantiator1());
        $this->assertTrue($t->has('something'));
        $this->assertFalse($t->has('wrong'));
        $t = new TypeMapAggregate(new ExampleInstantiator1(), new ExampleInstantiator1());
        $this->assertFalse($t->has('something'));
        $this->assertFalse($t->has('wrong'));
        $t = new TypeMapAggregate(new ExampleInstantiator1(), new ExampleInstantiator2());
        $this->assertTrue($t->has('something'));
        $this->assertTrue($t->has('foo'));
        $this->assertFalse($t->has('wrong'));
        $A = new ExampleInstantiator1();
        $t = new TypeMapAggregate($A, $A);
        $this->assertFalse($t->has('something'));
        $this->assertFalse($t->has('wrong'));
    }

}
