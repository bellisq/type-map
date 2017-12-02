<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\ZZZObjectAProviderMock;
use Bellisq\TypeMap\Tests\DI\ZZZObjectBProviderMock;


class ZZZDIContainerMock extends DIContainer
{

    public static function RegisterProviders(ProviderRegister $pr)
    {
        $pr->register(ZZZObjectAProviderMock::class)->register(ZZZObjectBProviderMock::class);
    }

}
