<?php

namespace Bellisq\TypeMap\Tests;

use Bellisq\TypeMap\ContainerInterface;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;


class TXContainerMock implements ContainerInterface
{

    public function __construct()
    {
        
    }

    public function get(string $type)
    {
        if ($type === 'foo') {
            return 'bar';
        }

        throw new ObjectNotFoundException($type);
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
