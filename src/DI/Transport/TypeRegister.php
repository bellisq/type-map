<?php

namespace Bellisq\TypeMap\DI\Transport;

use Bellisq\TypeMap\DI\Storage\TypeDefinition;
use Bellisq\TypeMap\Exceptions\DI\DuplicateTypeRegisteredException;


/**
 * [Class] Type Register
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class TypeRegister
{
    /** @var TypeDefinition */
    private $typeDefinition;

    /**
     * TypeRegister constructor.
     * @param TypeDefinition $typeDefinition
     */
    public function __construct(TypeDefinition $typeDefinition)
    {
        $this->typeDefinition = $typeDefinition;
    }

    /**
     * @param string $type
     * @return TypeRegister
     *
     * @throws DuplicateTypeRegisteredException
     */
    public function registerAsFactory(string $type): self
    {
        $this->typeDefinition->register($type, false);
        return $this;
    }

    /**
     * @param string $type
     * @return TypeRegister
     *
     * @throws DuplicateTypeRegisteredException
     */
    public function registerAsSingleton(string $type): self
    {
        $this->typeDefinition->register($type, true);
        return $this;
    }
}