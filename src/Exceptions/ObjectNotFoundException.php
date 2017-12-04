<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\TypeMapException;


/**
 * [ Exception ] Object Not Found
 * 
 * This exception will be thrown when a container does not have an object of the type required.
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class ObjectNotFoundException extends TypeMapException
{

    protected function generateMessage(string $type): string
    {
        return "Object of the type \"{$type}\" is not found.";
    }

}
