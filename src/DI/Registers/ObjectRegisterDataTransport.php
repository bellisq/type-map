<?php

namespace Bellisq\TypeMap\DI\Registers;


class ObjectRegisterDataTransport
{

    /** @var string[] */ private $objectTypes = [];

    public function add(string $objectTypeName)
    {
        $this->objectTypes[] = $objectTypeName;
    }

    public function get(): array
    {
        return $this->objectTypes;
    }

}
