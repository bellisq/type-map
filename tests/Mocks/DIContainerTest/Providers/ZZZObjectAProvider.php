<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Objects\ZZZObjectA;


class ZZZObjectAProvider implements ProviderInterface
{

    public function getInstance(string $type)
    {
        return new ZZZObjectA;
    }

    public static function registerObjects(ObjectRegister $or)
    {
        $or->register(ZZZObjectA::class);
    }

}