<?php

namespace Bellisq\TypeMap\Tests\DI\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\Providers\ZZZObjectAProvider;


class ZZZDuplicateProviderDIContainer extends DIContainer
{

    public static function registerProviders(ProviderRegister $providerRegister)
    {
        $providerRegister
            ->register(ZZZObjectAProvider::class)
            ->register(ZZZObjectAProvider::class);
    }

}
