<?php

namespace Bellisq\TypeMap\Tests\Mocks;

use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\InstantiatorInterface;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiatorClass;


class ZZZSimpleInstantiator implements InstantiatorInterface
{

    public function get(string $type)
    {
        switch ($type) {
            case ZZZSimpleInstantiatorClass::class:
                return new ZZZSimpleInstantiatorClass();
            default:
                throw new ObjectNotFoundException($type);
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
