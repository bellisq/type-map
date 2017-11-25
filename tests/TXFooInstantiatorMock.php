<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\InstantiatorInterface;
use Prophecy\Exception\InvalidArgumentException;
use Bellisq\TypeMap\Tests\Foo;


class TXFooInstantiatorMock implements InstantiatorInterface
{

    public function __construct()
    {
        
    }

    public function get(string $type)
    {
        switch ($type) {
            case Foo::class:
                return new Foo();
            default:
                throw new InvalidArgumentException();
        }
    }

    public function has(string $type): bool
    {
        switch ($type) {
            case Foo::class:
                return true;
            default:
                return false;
        }
    }

}
