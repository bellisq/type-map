<?php

namespace Bellisq\TypeMap\Tests\TestCases\DI;

use Bellisq\TypeMap\Exceptions\DI\CircularDependencyException;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectDependingOnB;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZRecursiveObject;
use Bellisq\TypeMap\Tests\Mocks\DI\ZZZInstantiator;
use Bellisq\TypeMap\Tests\Mocks\DI\ZZZRecursiveInstantiator;
use Bellisq\TypeMap\Utility\ObjectContainer;
use PHPUnit\Framework\TestCase;


class ZZZInstantiatorTest
    extends TestCase
{
    public function testBehavior()
    {
        $instantiator = new ZZZInstantiator(new ObjectContainer(new ZZZObjectB));

        $this->assertInstanceOf(
            ZZZObjectDependingOnB::class,
            $instantiator->get(ZZZObjectDependingOnB::class)
        );
    }

    public function testRecursive()
    {
        $instantiator = new ZZZRecursiveInstantiator(new ObjectContainer, true);

        $this->expectException(CircularDependencyException::class);
        $instantiator->get(ZZZRecursiveObject::class);
    }
}