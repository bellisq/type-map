<?php

namespace Bellisq\TypeMap\Tests\TestCases\Utility;

use Bellisq\TypeMap\Exceptions\InvalidArgumentDefinitionException;
use Bellisq\TypeMap\Exceptions\UnsupportedArgumentTypeException;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Objects\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiator;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiatorClass;
use Bellisq\TypeMap\Tests\Mocks\ZZZWrongInstantiatorClass;
use Bellisq\TypeMap\Utility\ArgumentCompletor;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;


class ZZZArgumentCompletorTest extends TestCase
{

    public function testComplete()
    {
        $x    = new ArgumentCompletor(new ZZZSimpleInstantiator());
        $args = $x->complete(new ReflectionMethod(ZZZArgumentCompletorTest::class, 't'));
        $this->assertEquals(1, $this->count($args));
        $this->assertInstanceOf(ZZZSimpleInstantiatorClass::class, $args[0]);
        $this->t(...$args);
    }

    public function t(ZZZSimpleInstantiatorClass $p)
    {
        $this->assertTrue(true);
    }

    public function testInvalidArgumentDefinitionException()
    {
        $this->expectException(InvalidArgumentDefinitionException::class);
        $x    = new ArgumentCompletor(new ZZZSimpleInstantiator());
        $x->complete(new ReflectionMethod(ZZZArgumentCompletorTest::class, 'wrong1'));

    }

    public function wrong1($p)
    {
        $this->assertTrue(true);
    }


    public function testUnsupportedArgumentTypeException()
    {
        $this->expectException(UnsupportedArgumentTypeException::class);
        $x    = new ArgumentCompletor(new ZZZSimpleInstantiator());
        $x->complete(new ReflectionMethod(ZZZArgumentCompletorTest::class, 'wrong2'));

    }

    public function wrong2(ZZZWrongInstantiatorClass$p)
    {
        $this->assertTrue(true);
    }

}
