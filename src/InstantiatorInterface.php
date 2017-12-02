<?php

namespace Bellisq\TypeMap;

use Bellisq\TypeMap\TypeMapInterface;


/**
 * [ Interface ] Instantiator Interface
 * 
 * In an Instantiator, the result of has() will be determined dynamically.
 * In other words, an Instantiator doesn't have the list of the objects which get() returns.
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
interface InstantiatorInterface extends TypeMapInterface
{
    
}
