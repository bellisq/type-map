<?php

namespace Bellisq\TypeMap\Tests\DI\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\Providers\ZZZObjectADuplicateProvider;


class ZZZDuplicateObjectDIContainer extends DIContainer
{

    public static function registerProviders(ProviderRegister $providerRegister)
    {
        $providerRegister
            ->register(ZZZObjectADuplicateProvider::class);
    }

}
