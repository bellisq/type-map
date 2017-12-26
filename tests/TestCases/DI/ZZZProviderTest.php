<?php

namespace Bellisq\TypeMap\Tests\TestCases\DI;

use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Tests\Mocks\DI\ZZZProvider;
use PHPUnit\Framework\TestCase;


class ZZZProviderTest
    extends TestCase
{
    public function testBehavior()
    {
        $provider = new ZZZProvider;
        $a1 = $provider->get(ZZZObjectA::class);
        $a2 = $provider->get(ZZZObjectA::class);
        $b1 = $provider->get(ZZZObjectB::class);
        $b2 = $provider->get(ZZZObjectB::class);

        $this->assertTrue($a1 == $a2);
        $this->assertTrue($b1 == $b2);


        $this->assertFalse($a1 === $a2);
        $this->assertTrue($b1 === $b2);
    }
}