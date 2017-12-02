<?php

namespace Bellisq\TypeMap\Tests\DI\Object;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\Object\ZZZObjectA;
use Bellisq\TypeMap\Tests\DI\Object\ZZZObjectB;


class ZZZObjectBProviderMock implements ProviderInterface
{

    public function __construct(ZZZObjectA $zoa)
    {
        
    }

    public static function registerObjects(ObjectRegister $or)
    {
        $or->register(ZZZObjectB::class);
    }

    public function getInstance(string $type)
    {
        return new ZZZObjectB;
    }

}
