<?php

namespace Bellisq\TypeMap\Tests\DI\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\Providers\ZZZObjectAProviderDependingOnObjectC;
use Bellisq\TypeMap\Tests\DI\Providers\ZZZObjectBProviderDependingOnObjectA;
use Bellisq\TypeMap\Tests\DI\Providers\ZZZObjectCProviderDependingOnObjectB;


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
