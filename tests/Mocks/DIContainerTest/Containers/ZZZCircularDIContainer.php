<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers\ZZZObjectAProviderDependingOnObjectC;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers\ZZZObjectBProviderDependingOnObjectA;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers\ZZZObjectCProviderDependingOnObjectB;


class ZZZCircularDIContainer extends DIContainer
{

    public static function registerProviders(ProviderRegister $providerRegister)
    {
        $providerRegister
            ->register(ZZZObjectAProviderDependingOnObjectC::class)
            ->register(ZZZObjectBProviderDependingOnObjectA::class)
            ->register(ZZZObjectCProviderDependingOnObjectB::class);
    }

}
