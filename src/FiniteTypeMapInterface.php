<?php

namespace Bellisq\TypeMap;

use Bellisq\TypeMap\TypeMapInterface;


/**
 * [Interface] Finite Type-map Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
interface FiniteTypeMapInterface
    extends TypeMapInterface
{
    /**
     * Get the list of supported types.
     *
     * The result MUST be consistent for one instance.
     *
     * @return string[]
     */
    public function list(): array;
}