<?php

namespace Bellisq\TypeMap\DI\Registers;


/**
 * [ Data Transport ] Object Register Data Transport
 * 
 * Help ObjectRegister encapsulate data by constructor-injection.
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class ObjectRegisterDataTransport
{

    /** @var string[] */ private $objectTypes = [];

    public function add(string $objectTypeName, bool $isSingleton = false)
    {
        $this->objectTypes[] = [$objectTypeName, $isSingleton];
    }

    public function get(): array
    {
        return $this->objectTypes;
    }

}
