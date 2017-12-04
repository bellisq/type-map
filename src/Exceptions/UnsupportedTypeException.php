<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\TypeMapException;


/**
 * [ Exception ] Unsupported Type
 * 
 * This exception will be thrown
 * when an instantiator does not support instantiation of the type required.
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class UnsupportedTypeException extends TypeMapException
{

    public function generateMessage(string $type): string
    {
        return "Failed to instantiate type {$type}.";
    }

}
