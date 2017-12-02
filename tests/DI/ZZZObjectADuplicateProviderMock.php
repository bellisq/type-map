<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\ZZZObjectA;


class ZZZObjectADuplicateProviderMock implements ProviderInterface
{

    public static function RegisterObjects(ObjectRegister $or)
    {
        $or->register(ZZZObjectA::class)->register(ZZZObjectA::class);
    }

    public function getInstance(string $type)
    {
        return new ZZZObjectA;
    }

}
