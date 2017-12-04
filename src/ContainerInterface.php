<?php

namespace Bellisq\TypeMap;

use Bellisq\TypeMap\TypeMapInterface;


/**
 * [ Interface ] Container Interface
 * 
 * In a Container, the result of has() is determined statically.
 * In other words, a Container holds the list of the objects which get() returns.
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
interface ContainerInterface extends TypeMapInterface
{
    
}
