<?php

namespace Bellisq\TypeMap\DI\Registers;


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
