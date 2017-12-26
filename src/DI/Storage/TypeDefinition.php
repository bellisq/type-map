<?php

namespace Bellisq\TypeMap\DI\Storage;

use Bellisq\TypeMap\Exceptions\DI\DuplicateTypeRegisteredException;


/**
 * [Class] Type Definition
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class TypeDefinition
{
    /** @var bool[] type => isSingleton */
    private $types = [];

    /**
     * @param string $type
     * @param bool $isSingleton
     *
     * @throws DuplicateTypeRegisteredException
     */
    public function register(string $type, bool $isSingleton)
    {
        if (isset($this->types[$type])) {
            throw new DuplicateTypeRegisteredException;
        }
        $this->types[$type] = $isSingleton;
    }

    /**
     * Returns the list of the types registered
     *
     * @return string[]
     */
    public function getList(): array
    {
        return array_keys($this->types);
    }

    /**
     * @param $type
     * @return bool
     */
    public function isSingleton($type): bool
    {
        assert(isset($this->types[$type]));
        return $this->types[$type];
    }
}