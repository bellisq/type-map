<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\Tests\DI\Object\ZZZObjectADuplicateProviderMock;


class ZZZDIContainerDuplicateObjectMock extends DIContainer
{

    public static function registerProviders(ProviderRegister $pr)
    {
        $pr->register(ZZZObjectADuplicateProviderMock::class);
    }

}
