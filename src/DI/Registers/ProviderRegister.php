<?php

namespace Bellisq\TypeMap\DI\Registers;

use Strict\Validator\ValidatorInterface;
use Bellisq\TypeMap\DI\Registers\ProviderRegisterDataTransport;
use Bellisq\TypeMap\Exceptions\InvalidProviderException;


/**
 * [ Register ] Provider Register
 * 
 * Let containers register providers they support.
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class ProviderRegister
{

    /** @var ProviderRegisterDataTransport */ private $prdt;

    /** @var ValidatorInterface */ private $vi;

    public function __construct(ProviderRegisterDataTransport $dataTransport, ValidatorInterface $providerTypeNameValidator)
    {
        $this->prdt = $dataTransport;
        $this->vi   = $providerTypeNameValidator;
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
