<?php

namespace Bellisq\TypeMap\Tests\DI\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\Providers\ZZZObjectAProvider;
use Bellisq\TypeMap\Tests\DI\Providers\ZZZObjectBProviderDependingOnObjectA;


class ZZZSimpleDIContainer extends DIContainer
{

    public static function registerProviders(ProviderRegister $providerRegister)
    {
        $providerRegister
            ->register(ZZZObjectAProvider::class)
            ->register(ZZZObjectBProviderDependingOnObjectA::class);
    }

}
