<?php

namespace Bellisq\TypeMap\Tests\Mocks\Base;

use Bellisq\TypeMap\Base\TypeMapAbstract;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;


class ZZZTypeMap
    extends TypeMapAbstract
{
    protected function getObject(string $type): object
    {
        return new ZZZObjectA;
    }

    public function supports(string $type): bool
    {
        return $type === ZZZObjectA::class;
    }
}