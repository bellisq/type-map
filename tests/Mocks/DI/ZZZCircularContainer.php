<?php

namespace Bellisq\TypeMap\Tests\Mocks\DI;

use Bellisq\TypeMap\DI\Container;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;


class ZZZCircularContainer
    extends Container
{
    protected static function registerProviders(ProviderRegister $providerRegister): void
    {
        $providerRegister
            ->registerFactory(
                function (ZZZObjectA $oa): ZZZObjectB {
                }
            )
            ->registerFactory(
                function (ZZZObjectB $ob): ZZZObjectA {
                }
            );
    }
}