<?php

namespace Bellisq\TypeMap\Tests\DI\Providers;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\Objects\ZZZObjectC as CurrentObject;
use Bellisq\TypeMap\Tests\DI\Objects\ZZZObjectB as RequiredObject;


class ZZZObjectCProviderDependingOnObjectB implements ProviderInterface
{

    public function __construct(RequiredObject $ro)
    {
        ;
    }

    public function getInstance(string $type)
    {
        return new CurrentObject;
    }

    public static function registerObjects(ObjectRegister $or)
    {
        $or->register(CurrentObject::class);
    }

}
