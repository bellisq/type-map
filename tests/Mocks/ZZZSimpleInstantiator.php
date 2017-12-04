<?php

namespace Bellisq\TypeMap\Tests\Mocks;

use Bellisq\TypeMap\InstantiatorInterface;
use Prophecy\Exception\InvalidArgumentException;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiatorClass;


class ZZZSimpleInstantiator implements InstantiatorInterface
{

    public function __construct()
    {
        
    }

    public function get(string $type)
    {
        switch ($type) {
            case ZZZSimpleInstantiatorClass::class:
                return new ZZZSimpleInstantiatorClass();
            default:
                throw new InvalidArgumentException();
        }
    }

    public function has(string $type): bool
    {
        switch ($type) {
            case ZZZSimpleInstantiatorClass::class:
                return true;
            default:
                return false;
        }
    }

}
