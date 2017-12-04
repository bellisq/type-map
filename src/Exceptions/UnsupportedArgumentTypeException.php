<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


/**
 * [ Exception ] Unsupported Constructor Argument Definition
 *
 * @author katayose
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class UnsupportedArgumentTypeException extends LogicException
{

    public function __construct()
    {
        parent::__construct('The type of the argument is not supported by the type-map given.');
    }

}
