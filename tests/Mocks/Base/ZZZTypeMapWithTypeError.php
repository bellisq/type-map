<?php

namespace Bellisq\TypeMap\Tests\Mocks\Base;

use Bellisq\TypeMap\Tests\Mocks\Base\ZZZTypeMap;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;


class ZZZTypeMapWithTypeError
    extends ZZZTypeMap
{
    public function getObject(string $type): object
    {
        return new ZZZObjectB;
    }
}