<?php

namespace Bellisq\TypeMap\Tests\Mocks\Base;

use Bellisq\TypeMap\Base\StaticTypeMapAbstract;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;


class ZZZStaticTypeMap
    extends StaticTypeMapAbstract
{
    protected function getObject(string $type): object
    {
        return new ZZZObjectA;
    }

    private static $called = false;

    public static function generatePredefinedList(): array
    {
        if (self::$called) {
            return [ZZZObjectA::class, ZZZObjectB::class];
        } else {
            self::$called = true;
            return [ZZZObjectA::class];
        }
    }
}