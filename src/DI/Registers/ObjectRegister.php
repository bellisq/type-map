<?php

namespace Bellisq\TypeMap\DI\Registers;

use Bellisq\TypeMap\DI\Registers\ObjectRegisterDataTransport;


class ObjectRegister
{

    /** @var ObjectRegisterDataTransport */ private $ordt;

    public function __construct(ObjectRegisterDataTransport $ordt)
    {
        $this->ordt = $ordt;
    }

    public function register(string $objectTypeName): self
    {
        $this->ordt->add($objectTypeName);
        return $this;
    }

}
