<?php

namespace Bellisq\TypeMap\Tests\Mocks\DI;

use Bellisq\TypeMap\DI\Container;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectDependingOnB;


class ZZZContainer
    extends Container
{
    protected static function registerProviders(ProviderRegister $providerRegister): void
    {
        $providerRegister
            ->registerFactory(function (ZZZObjectB $ob): ZZZObjectDependingOnB {
                return new ZZZObjectDependingOnB($ob);
            })
            ->registerSingleton(function (): ZZZObjectB {
                return new ZZZObjectB;
            })
            ->registerClass(ZZZObjectAProvider::class);
    }
}