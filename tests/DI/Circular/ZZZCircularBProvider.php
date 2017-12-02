<?php

namespace Bellisq\TypeMap\Tests\DI\Circular;

use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularB as Current;
use Bellisq\TypeMap\Tests\DI\Circular\ZZZCircularC as Dependent;


class ZZZCircularBProvider implements ProviderInterface
{

    public function __construct(Dependent $dep)
    {
        
    }

    public static function registerObjects(ObjectRegister $or)
    {
        $or->register(Current::class);
    }

    public function getInstance(string $type)
    {
        return new Current;
    }

}
