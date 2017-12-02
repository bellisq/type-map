<?php

namespace Bellisq\TypeMap\Tests\DI\Registers;

use PHPUnit\Framework\TestCase;
use Bellisq\TypeMap\DI\Registers\ObjectRegisterDataTransport;


class ZZZObjectRegisterDataTransportTest extends TestCase
{

    private $pdt;

    public function setUp()
    {
        $this->pdt = new ObjectRegisterDataTransport;
    }
    
    public function testBehavior() {
        $this->pdt->add('a');
        $this->pdt->add('b');
        $this->assertEquals([
            'a', 'b'
        ], $this->pdt->get());
    }

}
