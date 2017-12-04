<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers\ZZZObjectAProvider;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers\ZZZObjectBProviderDependingOnObjectA;


class ZZZSimpleDIContainer extends DIContainer
{

    public function registerProviders(ProviderRegister $providerRegister)
    {
        $providerRegister
            ->register(ZZZObjectAProvider::class)
            ->register(ZZZObjectBProviderDependingOnObjectA::class);
    }

}
