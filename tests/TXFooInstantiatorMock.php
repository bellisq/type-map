<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\InstantiatorInterface;
use Prophecy\Exception\InvalidArgumentException;


class TXFooInstantiatorMock implements InstantiatorInterface
{

    public function __construct()
    {

    }

    public function get(string $type)
    {
        switch ($type) {
            case 'Bellisq\TypeMap\Tests\Foo':
                return new Foo();
            default:
                throw new InvalidArgumentException();
        }
    }

    public function has(string $type): bool
    {
        switch ($type) {
            case 'Bellisq\TypeMap\Tests\Foo':
                return true;
            default:
                return false;
        }
    }

}
