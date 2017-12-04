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
        $this->assertEquals(ZZZSimpleInstantiatorClass::class, get_class($args[0]));
        $this->assertEquals(1, $this->count($args));
    }

    public function t(ZZZSimpleInstantiatorClass $p)
    {
        
    }

}
