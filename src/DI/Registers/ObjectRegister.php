<?php

namespace Bellisq\TypeMap\DI\Registers;

use Bellisq\TypeMap\DI\Registers\ObjectRegisterDataTransport;


/**
 * [ Register ] Object Register
 * 
 * Let providers register objects they support.
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class ObjectRegister
{

    /** @var ObjectRegisterDataTransport */ private $ordt;

    public function __construct(ObjectRegisterDataTransport $dataTransport)
    {
        $this->ordt = $dataTransport;
    }

    public function register(string $objectTypeName): self
    {
        $this->ordt->add($objectTypeName);
        return $this;
    }

    public function registerSingleton(string $objectTypeName): self
    {
        $this->ordt->add($objectTypeName, true);
        return $this;
    }

}
