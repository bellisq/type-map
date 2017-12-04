<?php

namespace Bellisq\TypeMap\Tests\Mocks;

use Bellisq\TypeMap\ContainerInterface;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleContainerClass;


class ZZZSimpleContainer implements ContainerInterface
{

    private $scc;

    public function __construct()
    {
        $this->scc = new ZZZSimpleContainerClass;
    }

    public function get(string $type)
    {
        if ($type === ZZZSimpleContainerClass::class) {
            return $this->scc;
        }

        throw new ObjectNotFoundException($type);
    }

    public function has(string $type): bool
    {
        return $type === ZZZSimpleContainerClass::class;
    }

}
