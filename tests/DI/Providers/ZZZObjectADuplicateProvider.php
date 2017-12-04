<?php

namespace Bellisq\TypeMap\Tests\DI\Providers;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\Objects\ZZZObjectA;


class ZZZObjectADuplicateProvider implements ProviderInterface
{

    public function getInstance(string $type)
    {
        return new ZZZObjectA;
    }

    public static function registerObjects(ObjectRegister $objectRegister)
    {
        $objectRegister
            ->register(ZZZObjectA::class)
            ->register(ZZZObjectA::class);
    }

}
