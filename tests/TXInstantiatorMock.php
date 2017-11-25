<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\TypeMapInterface;


class ExampleInstantiator1 implements TypeMapInterface
{

    public function __construct()
    {
        
    }

    public function get(string $type)
    {
        return 'hello';
    }

    public function has(string $type): bool
    {
        switch ($type) {
            case 'something':
                return true;
            default:
                return false;
        }
    }

}
