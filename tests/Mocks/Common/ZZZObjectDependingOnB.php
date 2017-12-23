<?php

namespace Bellisq\TypeMap\Tests\Mocks\Common;

use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectB;


class ZZZObjectDependingOnB
{
    public function __construct(ZZZObjectB $zb)
    {
    }
}