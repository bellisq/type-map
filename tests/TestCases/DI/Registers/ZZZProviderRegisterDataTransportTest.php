<?php

namespace Bellisq\TypeMap\Tests\DI\Registers;

use PHPUnit\Framework\TestCase;
use Bellisq\TypeMap\DI\Registers\ProviderRegisterDataTransport;


class ZZZProviderRegisterDataTransportTest extends TestCase
{

    private $pdt;

    public function setUp()
    {
        $this->pdt = new ProviderRegisterDataTransport;
    }
    
    public function testBehavior() {
        $this->pdt->add('a');
        $this->pdt->add('b');
        $this->assertEquals([
            'a', 'b'
        ], $this->pdt->get());
    }

}
