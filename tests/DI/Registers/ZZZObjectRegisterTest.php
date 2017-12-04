<?php

namespace Bellisq\TypeMap\Tests\DI\Registers;

use PHPUnit\Framework\TestCase;
use Bellisq\TypeMap\DI\Registers\ObjectRegisterDataTransport;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;


class ZZZObjectRegisterTest extends TestCase
{

    public function testBehavior()
    {
        $ordt = new ObjectRegisterDataTransport;
        $or   = new ObjectRegister($ordt);
        $or->register('a')->registerSingleton('b');
        $this->assertEquals([['a', false], ['b', true]], $ordt->get());
    }

}
