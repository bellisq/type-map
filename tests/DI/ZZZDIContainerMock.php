<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\ZZZObjectAProviderMock;
use Bellisq\TypeMap\Tests\DI\ZZZObjectBProviderMock;
use Bellisq\TypeMap\Tests\DI\ZZZCircularAProvider;
use Bellisq\TypeMap\Tests\DI\ZZZCircularBProvider;
use Bellisq\TypeMap\Tests\DI\ZZZCircularCProvider;


class ZZZDIContainerMock extends DIContainer
{

    public static function RegisterProviders(ProviderRegister $pr)
    {
        $pr->register(ZZZObjectAProviderMock::class)->register(ZZZObjectBProviderMock::class)
            ->register(ZZZCircularAProvider::class)
            ->register(ZZZCircularBProvider::class)
            ->register(ZZZCircularCProvider::class);
    }

}
