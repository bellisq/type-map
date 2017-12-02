<?php

namespace Bellisq\TypeMap\Tests\DI\Circular;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularC as Current;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularA as Dependent;


class ZZZCircularCProvider implements ProviderInterface
{

    public function __construct(Dependent $dep)
    {
        
    }

    public static function RegisterObjects(ObjectRegister $or)
    {
        $or->register(Current::class);
    }

    public function getInstance(string $type)
    {
        return new Current;
    }

}
