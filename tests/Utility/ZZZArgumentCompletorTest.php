<?php

namespace Bellisq\TypeMap\Tests\Utility;

use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiator;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiatorClass;
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

}
