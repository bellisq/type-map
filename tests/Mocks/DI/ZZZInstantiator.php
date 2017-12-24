<?php

namespace Bellisq\TypeMap\Tests\Mocks\DI;

use Bellisq\TypeMap\DI\Instantiator;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectDependingOnB;


class ZZZInstantiator
    extends Instantiator
{
    public function supports(string $type): bool
    {
        return $type === ZZZObjectDependingOnB::class;
    }
}