<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\Object\ZZZObjectAProviderMock;
use Bellisq\TypeMap\Tests\DI\Object\ZZZObjectBProviderMock;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularAProvider;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularBProvider;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularCProvider;


class ZZZDIContainerMock extends DIContainer
{

    public static function registerProviders(ProviderRegister $pr)
    {
        $pr->register(ZZZObjectAProviderMock::class)->register(ZZZObjectBProviderMock::class)
            ->register(ZZZCircularAProvider::class)
            ->register(ZZZCircularBProvider::class)
            ->register(ZZZCircularCProvider::class);
    }

}
