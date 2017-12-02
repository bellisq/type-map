<?php

namespace Bellisq\TypeMap\Tests\DI;

use PHPUnit\Framework\TestCase;
use Bellisq\TypeMap\Tests\DI\ZZZObjectA;
use Bellisq\TypeMap\Tests\DI\ZZZDIContainerMock;


class ZZZDIContainerTest extends TestCase
{

    private $dic;

    public function setUp()
    {
        $this->dic = new ZZZDIContainerMock;
    }

    public function testBehavior()
    {
        $this->assertInstanceOf(ZZZObjectB::class, $this->dic->get(ZZZObjectB::class));
        $this->assertInstanceOf(ZZZObjectA::class, $this->dic->get(ZZZObjectA::class));
    }
    

}
