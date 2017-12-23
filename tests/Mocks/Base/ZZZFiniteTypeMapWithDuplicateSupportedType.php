<?php

namespace Bellisq\TypeMap\Tests\Mocks\Base;

use Bellisq\TypeMap\Base\FiniteTypeMapAbstract;
use Bellisq\TypeMap\Tests\Mocks\Common\ZZZObjectA;


class ZZZFiniteTypeMapWithDuplicateSupportedType
    extends FiniteTypeMapAbstract
{
    public function __construct()
    {
        parent::__construct(ZZZObjectA::class, ZZZObjectA::class);
    }

    protected function getObject(string $type): object
    {
        return new ZZZObjectA;
    }
}