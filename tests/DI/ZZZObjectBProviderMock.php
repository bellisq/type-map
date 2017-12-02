<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\ZZZObjectA;
use Bellisq\TypeMap\Tests\DI\ZZZObjectB;


class ZZZObjectBProviderMock implements ProviderInterface
{

    public function __construct(ZZZObjectA $zoa)
    {
        
    }

    public static function RegisterObjects(ObjectRegister $or)
    {
        $or->register(ZZZObjectB::class);
    }

    public function getInstance(string $type)
    {
        return new ZZZObjectB;
    }

}
