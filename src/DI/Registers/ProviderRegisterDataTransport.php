<?php

namespace Bellisq\TypeMap\DI\Registers;


class ProviderRegisterDataTransport
{

    /** @var string[] */ private $providers = [];

    public function add(string $providerTypeName)
    {
        $this->providers[] = $providerTypeName;
    }

    public function get(): array
    {
        return $this->providers;
    }

}
