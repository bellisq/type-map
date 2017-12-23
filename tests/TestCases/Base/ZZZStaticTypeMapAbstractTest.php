<?php

namespace Bellisq\TypeMap\Tests\TestCases\Base;

use Bellisq\TypeMap\Tests\Mocks\Base\ZZZStaticTypeMap;
use PHPUnit\Framework\TestCase;


class ZZZStaticTypeMapAbstractTest
    extends TestCase
{
    public function testBehavior()
    {
        $typeMap = new ZZZStaticTypeMap;

        $this->assertEquals(ZZZStaticTypeMap::getPredefinedList(), $typeMap->list());
    }

    public function testConsistency()
    {
        $a = ZZZStaticTypeMap::getPredefinedList();
        $b = ZZZStaticTypeMap::generatePredefinedList();
        $c = ZZZStaticTypeMap::getPredefinedList();

        $this->assertNotEquals($a, $b);
        $this->assertEquals($a, $c);
    }
}