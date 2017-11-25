<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\Completion\ArgumentCompletor;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Exceptions\TooManyCandidatesException;
use Bellisq\TypeMap\TypeMapAggregate;
use PHPUnit\Framework\TestCase;


class TXArgumentCompletorTest extends TestCase
{

    public function testComplete()
    {
        $x = new ArgumentCompletor(new TXFooInstantiatorMock());
        $args = $x->complete(new \ReflectionMethod(TXArgumentCompletorTest::class, 't'));
        $this->assertEquals(Foo::class, get_class($args[0]));
        $this->assertEquals(1, $this->count($args));
    }

    public function t(Foo $p) {}
}
