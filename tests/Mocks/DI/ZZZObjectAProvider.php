<?php

namespace Bellisq\TypeMap\Tests\Mocks\DI;

use Bellisq\TypeMap\DI\Provider;
use Bellisq\TypeMap\DI\Transport\TypeRegister;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;


class ZZZObjectAProvider
    extends Provider
{
    protected function instantiateObject(string $type): object
    {
        return new $type;
    }

    protected static function registerTypes(TypeRegister $typeRegister): void
    {
        $typeRegister
            ->registerAsFactory(ZZZObjectA::class);
    }
}