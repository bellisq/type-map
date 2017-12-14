<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Containers;


use Bellisq\TypeMap\ContainerInterface;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Objects\ZZZObjectA;

class ZZZObjectAContainer implements ContainerInterface
{
    public function get(string $type)
    {
        if ($this->has($type)) {
            return new ZZZObjectA;
        } else {
            throw new ObjectNotFoundException;
        }
    }

    public function has(string $type): bool
    {
        return ZZZObjectA::class === $type;
    }
}