<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Containers;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers\ZZZObjectADuplicateProvider;


class ZZZDuplicateObjectDIContainer extends DIContainer
{

    public static function registerProviders(ProviderRegister $providerRegister)
    {
        $providerRegister
            ->register(ZZZObjectADuplicateProvider::class);
    }

}
