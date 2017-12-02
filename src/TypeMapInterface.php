<?php

namespace Bellisq\TypeMap;


/**
 * [ Interface ] TypeMap Interface
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
interface TypeMapInterface
{

    public function get(string $type);
    public function has(string $type): bool;

}
