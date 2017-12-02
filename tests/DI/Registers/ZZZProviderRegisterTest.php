<?php

namespace Bellisq\TypeMap\Tests\DI\Registers;

use PHPUnit\Framework\TestCase;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\DI\Registers\ProviderRegisterDataTransport;


class ZZZProviderRegisterTest extends TestCase
{

    public function testBehavior()
    {
        $prdt = new ProviderRegisterDataTransport;
        $pr   = new ProviderRegister($prdt);
        $pr->register('a')->register('b');
        $this->assertEquals(['a', 'b'], $prdt->get());
    }

}
