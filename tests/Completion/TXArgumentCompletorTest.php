<?php

namespace Bellisq\TypeMap\Tests\Completion;

use Bellisq\TypeMap\Completion\ArgumentCompletor;
use Bellisq\TypeMap\Tests\Completion\TXFooInstantiatorMock;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;


class TXArgumentCompletorTest extends TestCase
{

    public function testComplete()
    {
        $x    = new ArgumentCompletor(new TXFooInstantiatorMock());
        $args = $x->complete(new ReflectionMethod(TXArgumentCompletorTest::class, 't'));
        $this->assertEquals(ZZZFoo::class, get_class($args[0]));
        $this->assertEquals(1, $this->count($args));
    }

    public function t(ZZZFoo $p)
    {
        
    }

}
