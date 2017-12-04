<?php

namespace Bellisq\TypeMap\Tests\Utility;

use Bellisq\TypeMap\InstantiatorInterface;
use Prophecy\Exception\InvalidArgumentException;
use Bellisq\TypeMap\Tests\Utility\ZZZFoo;


class TXFooInstantiatorMock implements InstantiatorInterface
{

    public function __construct()
    {
        
    }

    public function get(string $type)
    {
        switch ($type) {
            case ZZZFoo::class:
                return new ZZZFoo();
            default:
                throw new InvalidArgumentException();
        }
    }

    public function has(string $type): bool
    {
        switch ($type) {
            case ZZZFoo::class:
                return true;
            default:
                return false;
        }
    }

}
