<?php

namespace Bellisq\TypeMap\DI\Registers;


/**
 * [ Data Transport ] Provider Register Data Transport
 * 
 * Help ProviderRegister encapsulate data by constructor-injection.
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
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
