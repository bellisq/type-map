<?php

namespace Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Providers;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Objects\ZZZObjectB as CurrentObject;
use Bellisq\TypeMap\Tests\Mocks\DIContainerTest\Objects\ZZZObjectA as RequiredObject;


class ZZZObjectBProviderDependingOnObjectA implements ProviderInterface
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
