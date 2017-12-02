<?php

namespace Bellisq\TypeMap\Tests\DI\Circular;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularA as Current;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularB as Dependent;


class ZZZCircularAProvider implements ProviderInterface
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
