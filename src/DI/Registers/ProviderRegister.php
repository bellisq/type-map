<?php

namespace Bellisq\TypeMap\DI\Registers;

use Bellisq\TypeMap\DI\Registers\ProviderRegisterDataTransport;


class ProviderRegister
{

    /** @var ProviderRegisterDataTransport */ private $prdt;

    public function __construct(ProviderRegisterDataTransport $prdt)
    {
        $this->prdt = $prdt;
    }

    public function register(string $providerTypeName): self
    {
        $this->prdt->add($providerTypeName);
        return $this;
    }

}
