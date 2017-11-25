<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\TypeMapInterface;


class ExampleInstantiator2 implements TypeMapInterface
{

    public function __construct()
    {
        
    }

    public function get(string $type)
    {
        return 'bar';
    }

    public function has(string $type): bool
    {
        switch ($type) {
            case 'foo':
                return true;
            default:
                return false;
        }
    }

}
