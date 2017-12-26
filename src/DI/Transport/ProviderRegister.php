<?php

namespace Bellisq\TypeMap\DI\Transport;

use Bellisq\TypeMap\DI\Storage\ProviderDefinition;
use Bellisq\TypeMap\Exceptions\DI\InvalidClassException;
use Bellisq\TypeMap\Exceptions\DI\UnqualifiedClosureException;
use Bellisq\TypeMap\Exceptions\DuplicateSupportedTypeException;
use Closure;


/**
 * [Class] Provider Register
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class ProviderRegister
{
    /** @var ProviderDefinition */
    private $definition;

    /**
     * ProviderRegister constructor.
     *
     * @param ProviderDefinition $definition
     */
    public function __construct(ProviderDefinition $definition)
    {
        $this->definition = $definition;
    }

    /**
     * @param Closure $providerClosure
     * @return ProviderRegister
     *
     * @throws DuplicateSupportedTypeException
     * @throws UnqualifiedClosureException
     */
    public function registerFactory(Closure $providerClosure): self
    {
        $this->definition->addFactory($providerClosure);
        return $this;
    }

    /**
     * @param Closure $providerClosure
     * @return ProviderRegister
     *
     * @throws DuplicateSupportedTypeException
     * @throws UnqualifiedClosureException
     */
    public function registerSingleton(Closure $providerClosure): self
    {
        $this->definition->addSingleton($providerClosure);
        return $this;
    }

    /**
     * @param string $providerClass
     * @return ProviderRegister
     *
     * @throws DuplicateSupportedTypeException
     * @throws InvalidClassException
     */
    public function registerClass(string $providerClass): self
    {
        $this->definition->addClass($providerClass);
        return $this;
    }
}