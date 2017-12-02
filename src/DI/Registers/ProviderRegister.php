<?php

namespace Bellisq\TypeMap\DI\Registers;

use Strict\Validator\ValidatorInterface;
use Bellisq\TypeMap\DI\Registers\ProviderRegisterDataTransport;
use Bellisq\TypeMap\Exceptions\InvalidProviderException;


class ProviderRegister
{

    /** @var ProviderRegisterDataTransport */ private $prdt;

    /** @var ValidatorInterface */ private $vi;

    public function __construct(ProviderRegisterDataTransport $prdt, ValidatorInterface $vi)
    {
        $this->prdt = $prdt;
        $this->vi   = $vi;
    }

    public function register(string $providerTypeName): self
    {
        if (!$this->vi->validate($providerTypeName)) {
            throw new InvalidProviderException;
        }
        $this->prdt->add($providerTypeName);
        return $this;
    }

}
