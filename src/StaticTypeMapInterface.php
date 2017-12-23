<?php

namespace Bellisq\TypeMap;

use Bellisq\TypeMap\FiniteTypeMapInterface;


/**
 * [Interface] Static Type-map Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
interface StaticTypeMapInterface
    extends FiniteTypeMapInterface
{
    /**
     * Get the predefined (static) list of supported types.
     *
     * The result MUST be consistent for one class.
     *
     * @return string[]
     */
    public static function getPredefinedList(): array;
}