<?php

namespace Bellisq\TypeMap\Tests\Mocks\Common;


class ZZZRecursiveObject
{
    public function __construct(ZZZRecursiveObject $o)
    {
    }
}