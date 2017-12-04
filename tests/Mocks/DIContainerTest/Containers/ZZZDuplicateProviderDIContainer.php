<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers\ZZZObjectAProvider;


class ZZZDuplicateProviderDIContainer extends DIContainer
{

    public function registerProviders(ProviderRegister $providerRegister)
    {
        $providerRegister
            ->register(ZZZObjectAProvider::class)
            ->register(ZZZObjectAProvider::class);
    }

}
