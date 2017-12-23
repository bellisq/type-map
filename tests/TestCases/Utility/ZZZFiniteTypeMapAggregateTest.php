<?php

namespace Bellisq\TypeMap\Tests\TestCases\Utility;

use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Utility\ObjectContainer;
use Bellisq\TypeMap\Utility\FiniteTypeMapAggregate;
use PHPUnit\Framework\TestCase;
use stdClass;


class ZZZFiniteTypeMapAggregateTest
    extends TestCase
{
    public function testBehavior()
    {
        $c1 = new ObjectContainer(new ZZZObjectA, [new ZZZObjectB(), stdClass::class]);
        $c2 = new ObjectContainer(new stdClass());

        $aggregate = new FiniteTypeMapAggregate($c1, $c2);

        $this->assertTrue($aggregate->supports(ZZZObjectA::class));
        $this->assertFalse($aggregate->supports(ZZZObjectB::class));
        $this->assertTrue($aggregate->supports(stdClass::class));

        $s1 = new FiniteTypeMapAggregate($c1, $c2);
        $this->assertInstanceOf(stdClass::class, $s1->get(stdClass::class));
        $this->assertNotInstanceOf(ZZZObjectB::class, $s1->get(stdClass::class));

        $s2 = new FiniteTypeMapAggregate($c2, $c1);
        $this->assertInstanceOf(ZZZObjectB::class, $s2->get(stdClass::class));

        $s1 = new FiniteTypeMapAggregate(new FiniteTypeMapAggregate($c1), $c2);
        $this->assertInstanceOf(stdClass::class, $s1->get(stdClass::class));
        $this->assertNotInstanceOf(ZZZObjectB::class, $s1->get(stdClass::class));

        $s2 = new FiniteTypeMapAggregate($c1, new FiniteTypeMapAggregate($c2, $c1));
        $this->assertInstanceOf(ZZZObjectB::class, $s2->get(stdClass::class));
    }
}