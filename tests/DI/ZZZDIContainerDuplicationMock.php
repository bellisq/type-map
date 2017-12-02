<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\ZZZObjectAProviderMock;


class ZZZDIContainerDuplicationMock extends DIContainer
{

    public static function RegisterProviders(ProviderRegister $pr)
    {
        $pr->register(ZZZObjectAProviderMock::class)->register(ZZZObjectAProviderMock::class);
    }

}
