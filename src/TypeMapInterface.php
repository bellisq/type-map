<?php

namespace Bellisq\TypeMap;

use Bellisq\TypeMap\Exceptions\UnavailableTypeException;


/**
 * [Interface] Type-map Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
interface TypeMapInterface
{
    /**
     * Get an object of the type.
     *
     * @param string $type
     * @return object
     *
     * @throws UnavailableTypeException
     */
    public function get(string $type): object;

    /**
     * Tell whether this type-map supports the type or not.
     *
     * @param string $type
     * @return bool
     */
    public function supports(string $type): bool;
}