<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Objects\ZZZObjectC;


class ZZZObjectCSingletonProvider implements ProviderInterface
{

    public function getInstance(string $type)
    {
        return new ZZZObjectC;
    }

    public static function registerObjects(ObjectRegister $objectRegister)
    {
        $objectRegister
            ->registerSingleton(ZZZObjectC::class);
    }

}
