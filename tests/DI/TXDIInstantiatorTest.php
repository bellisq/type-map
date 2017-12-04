<?php

namespace Bellisq\TypeMap\Tests\DI;

use Bellisq\TypeMap\DI\DIInstantiator;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiator;
use Bellisq\TypeMap\Tests\Mocks\ZZZSimpleInstantiatorClass;
use PHPUnit\Framework\TestCase;


class TXDIInstantiatorTest extends TestCase
{

    public function testGet()
    {
        $dii = new DIInstantiator(new ZZZSimpleInstantiator());
        $this->assertEquals(ZZZSimpleInstantiatorClass::class, get_class($dii->get(ZZZSimpleInstantiatorClass::class)));
    }

    public function testObjectNotFoundException()
    {
        $dii = new DIInstantiator(new ZZZSimpleInstantiator());
        $this->expectException(ObjectNotFoundException::class);
        $this->assertEquals(ZZZSimpleInstantiatorClass::class, get_class($dii->get('wrong')));
    }

    public function testHas()
    {
        $dii = new DIInstantiator(new ZZZSimpleInstantiator());
        $this->assertTrue($dii->has(ZZZSimpleInstantiatorClass::class));
        $this->assertFalse($dii->has('wrong'));
    }

}
